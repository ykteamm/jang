<script>
    $(document).ready(function(){
        
        $(".live-reyting").click(function(){
            livewire.emit('for_reyting');
        });

        $(".live-region").click(function(){
            livewire.emit('for_region');
        });

        $(".live-turnir").click(function(){
            livewire.emit('for_turnir');
        });

        $(".live-plan").click(function(){
            livewire.emit('for_plan');
        });

        $(".live-liga").click(function(){
            livewire.emit('for_liga');
        });

        $('.live-market').click(function(){
            livewire.emit('for_market');
        });

        $('.live-history-crystal').click(function(){
            livewire.emit('for_history_crystal');
        });
        
        getUserCrystall()

        setTimeout(function() { 
                livewire.emit('for_profil'); 
                livewire.emit('for_money'); 
        }, 1500);

        setTimeout(function() { 
                livewire.emit('for_teambattle'); 
        }, 1000);
        
        setTimeout(function() { 
                livewire.emit('for_info'); 
        }, 3000);
    });
    
    function showRegion(id) {
        livewire.emit('regionlive',id);
    }

    function upModal(id) {
        livewire.emit('profiluserlive',id);
    }

    function changeReytingTabrey(number) {
        $('.reyting-tab-class').removeClass('new-reyting-tab-active');
        $('.reyting-tab-class').addClass('new-reyting-tab');

        $(`.reyting-tab${number}`).removeClass('new-reyting-tab');
        $(`.reyting-tab${number}`).addClass('new-reyting-tab-active');
    }

    function changeReytingTab(number) {
        $('.reyting-tab-class').removeClass('reyting-tab-active');
        $('.reyting-tab-class').addClass('reyting-tab');

        $(`.reyting-tab${number}`).removeClass('reyting-tab');
        $(`.reyting-tab${number}`).addClass('reyting-tab-active');
    }

    function getUserCrystall() {
            $.ajax({
                url: '/user-crystall',
                method: 'get',
                contentType: false,
                processData: false,
                success: (response) => {
                    $("#userCrystall").append(`<div>${response}</div>`);
                    $("#userCrystallMain").append(`<div>${response}</div>`);
                }
            })
        }
</script>
<script>
    function changeTab1() {
        let tab1 = document.querySelector(`#turnirTab1`)
        let tab2 = document.querySelector(`#turnirTab2`)
        let tabmain1 = document.querySelector(`#turnir1tab`)
        let tabmain2 = document.querySelector(`#turnir2tab`)
        tab2.classList.remove('active')
        tab1.classList.add('active')
        tabmain1.classList.remove('d-none')
        tabmain2.classList.add('d-none')
    }

    function changeTab2() {
        let tab1 = document.querySelector(`#turnirTab1`)
        let tab2 = document.querySelector(`#turnirTab2`)
        let tabmain1 = document.querySelector(`#turnir1tab`)
        let tabmain2 = document.querySelector(`#turnir2tab`)
        tab2.classList.add('active')
        tab1.classList.remove('active')
        tabmain1.classList.add('d-none')
        tabmain2.classList.remove('d-none')
    }
</script>