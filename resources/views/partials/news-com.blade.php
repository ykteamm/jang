<script>



    $(document).ready(function(){

        setTimeout(function() {
            $('.class-news').click(function(){
                getAllNews()
                livewire.emit('for_newsin');
            });
        }, 4000);


    });

        function readNotificationEvent(id) {
            $.ajax({
                url: `/read-notification/${id}`,
                method: 'get',
                contentType: false,
                processData: false,
                success: (response) => {
                    if(response > 0) {
                        $("#newsNotifCount").text(response);
                    } else {
                        $("#newsNotifCount").empty()
                        $("#newsNotifCountParent").empty()
                    }
                }
            })

        }

        function showNw(id) {
            $("#showNw" + id).click()
        }

        function showInfo(id) {
            $("#showInfo" + id).click()
        }

        function showVid(id) {
            $("#showVid" + id).click()
        }

    function setReaction() {
            setTimeout(() => {
                getAllNews();
            }, 1000);
        }
    function getAllNews() {
            let months = [
                'Yanvar',
                'Fevral',
                'Mart',
                'Aprel',
                'May',
                'Iyun',
                'Iyul',
                'August',
                'Sentabr',
                'Oktabr',
                'Noyabr',
                'Dekabr'
            ]
            $("#allnews").empty();
            $.ajax({
                url: '/allnews',
                method: 'get',
                contentType: false,
                processData: false,
                success: (response) => {
                    response.forEach(nw => {
                        let date = new Date(nw.created_at);
                        let emojies = nw.emojies.map(e => (`
                        <div class="mr-1 d-flex align-items-center justify-content-center">
                            <span class="pr-1" style="color:#78787c;font-size:12px;z-index:1000; font-weight:600">
                                ${e.count}
                            </span>
                            <span class="d-flex align-items-center justify-content-center" style="width:16px;height:16px">
                                ${e.icon}
                            </span>
                        </div>`))
                        .join("");
                        $("#allnews").append(`
                    <div class="news-card border mb-3 shadow bg-white"
                                style="height: 100px;padding:10px;border-radius:16px">
                                <div class="d-flex align-items-center">
                                    <div onclick="showNw(${nw.id})" data-toggle="modal" data-target="#showNws" style="width: 80px;height:80px;border-radius:8px;">
                                        <img src="${nw.img}" width="80" height="80" alt="">
                                    </div>
                                    <div style="height:80px;padding-left:10px;width:100%">
                                        <div class="d-flex align-items-center justify-content-between w-100"
                                            style="margin-bottom:5px;">
                                            <div style="font-size:11px;color:blue;font-weight:500">
                                                News
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between">
                                                ${emojies}
                                            </div>
                                        </div>
                                        <div onclick="showNw(${nw.id})" data-toggle="modal" data-target="#showNws" class="supercell"
                                            style="font-weight:600;overflow:hidden;font-size:11px;height:35px">
                                            ${nw.title}
                                        </div>
                                        <div onclick="showNw(${nw.id})" data-toggle="modal" data-target="#showNws" style="margin-top:8px" class="d-flex justify-content-between">
                                            <div class="d-flex">
                                                <div
                                                    style="font-weight:500;font-size:11px;height:10px;color:#78787c">
                                                    ${date.getDate()} -
                                                    ${months[date.getMonth()]}
                                                </div>
                                                <div class="ml-4" style="opacity:0.6">
                                                    <div class="mr-1 d-flex align-items-center justify-content-center">
                                                        <span class="pr-1" style="color:#78787c;font-size:12px;z-index:1000; font-weight:600;opacity:0.8">
                                                            ${nw.shows.length > 0 ? nw.shows[0].show : 0}
                                                        </span>
                                                        <span class="d-flex align-items-center justify-content-center" style="width:14px;height:14px;opacity:0.6">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                            </svg>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="margin-top:-10px">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    `)
                    })
                }
            })
        }


</script>
