<?php

namespace App\Services;

use App\Models\AllSold;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class MakeImageService
{
  private $img;
  private $nameFont;
  private $ballFont;
  private $width;
  private $height;
  private $nameFontSize = 50;
  private $ballFontSize = 55;
  private $textFontSize = 40;

  public function __construct()
  {
    $this->img = imagecreatefromjpeg(public_path('winners/template.jpeg'));
    $this->nameFont = public_path('fonts/Roboto-Regular.ttf');
    $this->ballFont = public_path('fonts/Roboto-Bold.ttf');
    $this->width = imagesx($this->img);
    $this->height = imagesy($this->img);
  }

  private function color(int $r, int $g, int $b) { return imagecolorallocate($this->img, $r, $g, $b); }

  private function name(string $text, int $x, int $y, int $size, int $color) {
    imagettftext($this->img, $size, 0, $x, $y, $color, $this->nameFont, $text);
    return $this;
  }

  private function text(string $text, int $x, int $y, int $size, int $color) {
    imagettftext($this->img, $size, 0, $x, $y, $color, $this->ballFont, $text);
    return $this;
  }

  private function makeRectLose($w, $h, int $dst_x, int $dst_y, int $src_x, int $src_y, $summa)
  {
    $image = imagecreate($w, $h);
    imagecolorallocate($image, 181, 26, 26);
    $color = imagecolorallocate($image, 255, 255, 255);
    imagealphablending($image, true);
    $sum = str_split((string)$summa);
    $len = count($sum);
    $summa = number_format($summa, 0, '', ' ');
    // $new = [];
    // for ($i = $len - 1; $i >= 0; $i--) {
    //   if($i % 3 == 0 && $i != ($len - 1)) {
    //     $new[] = ".";
    //   }
    //   $new[] = $sum[$i];
    // }
    // $summa = join("", array_reverse($new));

    $start = ($w - $len * 40) / 2;
    imagettftext($image, 35, 0, $start + 30, 55, $color, $this->ballFont, $summa);
    imagecopymerge($this->img, $image, $dst_x, $dst_y, $src_x, $src_y, $w, $h, 100);
    return $this;
  }

  private function makeRectWin($w, $h, int $dst_x, int $dst_y, int $src_x, int $src_y, $summa)
  {
    $image = imagecreate($w, $h);
    imagecolorallocate($image, 21, 181, 35);
    $color = imagecolorallocate($image, 255, 255, 255);
    imagealphablending($image, true);
    $sum = str_split((string)$summa);
    $len = count($sum);
    $summa = number_format($summa, 0, '', ' ');
    // $new = [];
    // for ($i = $len - 1; $i >= 0; $i--) {
    //   if($i % 3 == 0 && $i != ($len - 1)) {
    //     $new[] = ".";
    //   }
    //   $new[] = $sum[$i];
    // }
    // $summa = join("", array_reverse($new));
    $start = ($w - $len * 40) / 2;
    imagettftext($image, 35, 0, $start + 30, 55, $color, $this->ballFont, $summa);
    imagecopymerge($this->img, $image, $dst_x, $dst_y, $src_x, $src_y, $w, $h, 100);
    return $this;
  }

  private function setImage($path, int $dst_x, int $dst_y, int $src_x, int $src_y, int $src_width, int $src_height, int $pct)
  {
    $image_s = imagecreatefromstring(file_get_contents($path));
    $size = min(imagesx($image_s), imagesy($image_s));
    $image_s = imagecrop($image_s, ['x' => 0, 'y' => 0, 'width' => $size, 'height' => $size]);

    $img_width = imagesx($image_s);
    $img_height = imagesy($image_s);

    $image = imagecreatetruecolor($src_width, $src_height);
    imagealphablending($image, true);
    imagecopyresampled($image, $image_s, 0, 0, 0, 0, $src_width, $src_height, $img_width, $img_height);

    $mask = imagecreatetruecolor($src_width, $src_height);
    $transparent = imagecolorallocate($mask, 0, 0, 255);
    imagecolortransparent($mask, $transparent);

    imagefilledellipse($mask, $src_width / 2, $src_height / 2, $src_width, $src_height, $transparent);
    $red = imagecolorallocate($mask, 0, 0, 0);
    imagecopymerge($image, $mask, 0, 0, 0, 0, $src_width, $src_height, 100);
    imagecolortransparent($image, $red);
    imagefill($image, 0, 0, $red);

    imagecopymerge($this->img, $image, $dst_x, $dst_y, $src_x, $src_y, $src_width, $src_height, 100);
    return $this;
  }

  private function save($filePath) { imagepng($this->img, $filePath); return $this; }

  private function print() { imagepng($this->img); return $this; }

  private function destroy() { imagedestroy($this->img); }

  public function make($battle)
  {

    if($battle['win_image'] !== NULL){
      return asset("winners/" . $battle['win_image']);
    }


    // $id1 = $battle['user1id'];
    // $id2 = $battle['user2id'];

    $sold1 = AllSold::where('user_id',$battle['user1id'])
    ->whereDate('created_at','>=',$battle['begin'])
    ->whereDate('created_at','<=',$battle['end'])
    ->sum(DB::raw('price_product*number'));

    $sold2 = AllSold::where('user_id',$battle['user2id'])
    ->whereDate('created_at','>=',$battle['begin'])
    ->whereDate('created_at','<=',$battle['end'])
    ->sum(DB::raw('price_product*number'));


    if($sold1 > $sold2)
    {
        $winner = User::find($battle['user1id']);
        $loser = User::find($battle['user2id']);
    }else{
        $winner = User::find($battle['user2id']);
        $loser = User::find($battle['user1id']);
    }


    if($winner == NULL || $loser == NULL) {
      return NULL;
    }

    $winnerName = $this->namer($winner);
    $loserName = $this->namer($loser);

    $sum1 = $this->summer($winner->id, $battle['begin'], $battle['end']);
    $sum2 = $this->summer($loser->id, $battle['begin'], $battle['end']);
    $ball = 12;
    // dd($battle, $sum1, $sum2, $ball);

    $imgName = date("Y-m-d-h-m-s") . ".png";
    $innerPath = public_path('winners/' . $imgName);
    $outerPath = asset('winners/' . $imgName);
    $qilich = public_path('mobile/ksb.jpg');
    $lenWin =strlen($winnerName);
    $lenLose = strlen($loserName);
    if(preg_match('/[^\x20-\x7e]/', $winnerName)) {
      $lenWin /= 2;
    }
    if(preg_match('/[^\x20-\x7e]/', $loserName)) {
      $lenLose /= 2;
    }
    $winnerNameStart = ($this->width - ($lenWin * $this->nameFontSize)) / 2;
    $ballStart = ($this->width - (strlen($ball) * $this->ballFontSize)) / 2;
    if($lenLose <= 7) {
      $loserNameStart = $this->width - ($lenLose * $this->textFontSize) - $this->textFontSize - 10;
    } else {
      $loserNameStart = $this->width - ($lenLose * $this->textFontSize) - 10;
    }
    // header("Content-Type: image/png");
    $this->name(strtoupper($winnerName), $winnerNameStart + 50, 1620, $this->nameFontSize, $this->color(255, 255, 255))
        ->text(strtoupper('golib'), $ballStart + strlen($ball) * 10, 1740, $this->ballFontSize, $this->color(255, 255, 255))
        ->text(strtoupper($winnerName), 130, 140, $this->textFontSize, $this->color(255, 255, 255))
        ->text(strtoupper($loserName), $loserNameStart, 140, $this->textFontSize, $this->color(255, 255, 255))
        ->setImage($winner['image_url'], 282, 512, 0, 0, 520, 520, 100)
        ->setImage($qilich, 473, 100, 0, 0, 130, 130, 100)
        ->makeRectWin(300, 80, 130, 170, 0, 0, $sum1)
        ->makeRectLose(300, 80, 650, 170, 0, 0, $sum2)
        ->save($innerPath)
        // ->print()
        ->destroy();

    DB::table('mega_turnir_user_battles')
      ->where('id', $battle['id'])
      ->update(['win_image' => $imgName]);

    return $outerPath;
  }

  private function summer($uid, $start, $end)
  {
    $summa = DB::table('tg_productssold')
              ->selectRaw('SUM(tg_productssold.price_product * tg_productssold.number) AS summa')
              ->where('tg_productssold.user_id', $uid)
              ->whereDate('tg_productssold.created_at', '>=', $start)
              ->whereDate('tg_productssold.created_at', '<=', $end)
              ->get()[0]->summa;
      if($summa == null)
      {
        $summa = 0;
      }
      return $summa;
  }

  private function namer($user) {
    if(preg_match('/[^\x20-\x7e]/', $user['first_name'])) {
      $name = strlen($user['first_name']) > 18 ? substr($user['first_name'], 0, 18) : $user['first_name'];
      return $name . "." . substr($user['last_name'], 0, 2);
    }
    $name = strlen($user['first_name']) > 9 ? substr($user['first_name'], 0, 9) : $user['first_name'];
    return $name . "." . substr($user['last_name'], 0, 1); }
}
