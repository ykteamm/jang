<div class="modal fade" id="kingliga" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-sm modal-dialog-scrollable h-100" role="document">
        <div class="modal-content h-100" style="background: #002bff17 !important">
            <div class="modal-body pt-5">
                @if ($user_king_liga)
                    <h2 class="supercell text-white text-center pt-5" style="line-height: 45px">
                        Sizda
                        @switch($user_king_liga->king_liga_id)
                            @case(4)
                                <strong style="color: #b57208">
                                    <br>
                                    <img width="40" src="{{ asset('mobile/ligabronza.webp') }}" alt="b">
                                    Bronza
                                    <img width="40" src="{{ asset('mobile/ligabronza.webp') }}" alt="b">
                                    <br>
                                </strong>
                            @break

                            @case(3)
                                <strong style="color:#bcdafd">
                                    <br>
                                    <img width="40" src="{{ asset('mobile/ligakumush.webp') }}" alt="k">
                                    Kumush
                                    <img width="40" src="{{ asset('mobile/ligakumush.webp') }}" alt="k">
                                    <br>
                                </strong>
                            @break

                            @case(2)
                                <strong style="color:#f1cb11">
                                    <br>
                                    <img width="40" src="{{ asset('mobile/ligaoltin.webp') }}" alt="o">
                                    Oltin
                                    <img width="40" src="{{ asset('mobile/ligaoltin.webp') }}" alt="o">
                                    <br>
                                </strong>
                            @break
                        @endswitch
                        ligasiga o'tish imkoniyati bor. O'tishni hohlaysizmi ?
                    </h2>
                @endif
                <div class="row pt-5">
                    <div class="col-6 text-center">
                        <form action="{{ route('inc-king-liga', ['yes' => 0]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn w-90 btn-danger supercell">Yo'q</button>
                        </form>
                    </div>
                    <div class="col-6 text-center">
                        <form action="{{ route('inc-king-liga', ['yes' => 1]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn w-90 btn-success supercell">Ha</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
