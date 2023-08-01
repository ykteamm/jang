<script>
    
    var lastSwiperTouch = Date.now();
    swiper = new Swiper(".swiper-container", {
          touchEventsTarget: "wrapper",
          on: {
            touchEnd: function () {
              lastSwiperTouch = Date.now();
            },
            slideChange: function () {
              if (lastSwiperTouch && ((Date.now() - lastSwiperTouch) < 200)) {

              }
            }
          }
        });

</script>