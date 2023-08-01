<script>
    function myChart(plan, fact) {
        let series = [];
        let colors = [];
        if (fact > plan) {
            var done = Math.floor((plan / fact) * 100);
            var notDone = done < 100 ? 100 - done : 0;
            series = [notDone, done]
            colors = ['rgb(102, 93, 200)', 'rgb(93, 200, 93)']
        } else {
            var done = Math.floor((fact / plan) * 100);
            var notDone = done < 100 ? 100 - done : 0;
            series = [done, notDone]
            colors = ['rgb(93, 200, 93)', 'rgb(217, 70, 70)']
        }
        var options = {
            series,
            colors,
            chart: {
                type: 'donut',
                fontFamily: 'monospace',
                dropShadow: {},
                toolbar: {
                    show: false
                },
                zoom: {
                    enabled: false
                },
                selection: {
                    enabled: false
                },
                animations: {
                    enabled: true
                }
            },
            plotOptions: {},
            dataLabels: {
                enabled: true,
                textAnchor: 'end',
                offsetX: 20,
                offsetY: 300,
                style: {
                    fontSize: 15,
                    fontWeight: 700,
                    fontFamily: 'monospace',
                    colors: ['yellow', 'yellow']
                },
                background: {
                    enabled: true,
                    foreColor: '#000',
                    borderRadius: 10,
                    padding: 10,
                    opacity: 0.9,
                    borderWidth: 1,
                    borderColor: '#000'
                },
                formatter(val, opts) {
                    if (fact > plan) {
                        if (opts.seriesIndex == 0) {
                            let qol = fact - plan;
                            return qol.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',') + " so'm"
                        } else if (opts.seriesIndex == 1) {
                            return fact.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',') + " so'm";
                        }
                    } else {
                        if (opts.seriesIndex == 0) {
                            return fact.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',') + " so'm";
                        } else if (opts.seriesIndex == 1) {
                            let qol = plan - fact;
                            return qol.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',') + " so'm"
                        }
                    }
                }
            },
            legend: {
                show: false,
                position: 'bottom',
                formatter(legendName, opts) {
                    if (opts.seriesIndex == 0) {
                        return "Fact";
                    } else if (opts.seriesIndex == 1) {
                        return "Plangacha qolgani"
                    }
                },
                fontSize: 16,
                labels: {
                    colors: 'rgb(57, 12, 180)'
                }
            },
            fill: {
                opacity: 1
            },
        };
        var chrt = new ApexCharts(document.querySelector(".planChart"), options);
        chrt.render();
    }

    async function showChart(date) {
        await $.ajax({
            url: `/plan/${date}`,
            type: "GET",
            success: function(res) {
                myChart(res.plan, res.fact)
            }
        });
    }
</script>




<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>


<script src="{{ asset('mobile/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('mobile/js/popper.min.js') }}"></script>
<script src="{{ asset('mobile/vendor/bootstrap/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('mobile/js/jquery.cookie.js') }}"></script>

<script src="{{ asset('mobile/vendor/swiper/js/swiper.min.js') }}"></script>

<script src="{{ asset('mobile/js/main.js') }}"></script>
<script src="{{ asset('mobile/js/color-scheme-demo.js') }}"></script>

<script src="{{ asset('mobile/js/app.js') }}"></script>
