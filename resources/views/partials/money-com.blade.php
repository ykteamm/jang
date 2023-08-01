<script>
    $(document).ready(function(){

        setTimeout(function() { 
            liveMoneyModal()
            liveMarket()
            livePlan()
        }, 3000);

    });

    function liveMoneyModal()
    {
        livewire.emit('for_money_modal');
    }

    function liveMarket()
    {
        livewire.emit('for_market');
    }

    function livePlan()
    {
        livewire.emit('for_plan');
    }
</script>