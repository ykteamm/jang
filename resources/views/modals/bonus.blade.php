<div class="modal fade" id="bonus" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-sm modal-dialog-centered" role="document">
        <div class="modal-content bg-transparent d-flex justify-content-center align-items-center">
            
            <livewire:market />
            
        </div>
    </div>
</div>
<script>
    window.addEventListener('load',
        function() {
            let wishList = localStorage.getItem('wishList')
            if (wishList) {
                let newList = JSON.parse(wishList);
                changeWishList(newList)
            }
        }, false)

    function saveWishList(item) {
        let wishList = localStorage.getItem('wishList')
        if (!wishList) {
            let newList = [item];
            localStorage.setItem('wishList', JSON.stringify(newList))
            changeWishList(newList)
        } else {
            let newList = JSON.parse(wishList);
            let index = newList.findIndex(w => w.id === item.id);
            if (index !== -1) {
                newList.splice(index, 1)
            } else {
                newList.push(item)
            }
            localStorage.setItem('wishList', JSON.stringify(newList))
            changeWishList(newList)
        }
    }

    function unsaveWishList(itemId) {
        let wishList = JSON.parse(localStorage.getItem('wishList'))
        let index = wishList.findIndex(w => w.id === itemId);
        wishList.splice(index, 1)
        document.getElementById("outerMarket" + itemId).style.display = 'flex';
        localStorage.setItem('wishList', JSON.stringify(wishList))
        changeWishList(wishList)
    }

    function changeWishList(wishList) {
        wishList = wishList.sort((a, b) => b.crystall - a.crystall);
        $("#wishListItems").css('margin-bottom', '20px')
        if (wishList.length == 0) {
            $("#wishListItemsTitle").empty()
            $("#wishListItems").css('margin-bottom', 0)
        } else if (wishList.length == 1) {
            $("#wishListItemsTitle").empty()
            $("#wishListItemsTitle").append(
                `<div id="wishListItemsTitle" class="supercell text-center">
                    Sevimlilar
                </div>`)
        } else {

        }
        if(wishList.length > 0) {
            $("#topWishMarket").empty()
            let wish = wishList[0];
            $.ajax({
                url: '/user-crystall',
                method: 'get',
                contentType: false,
                processData: false,
                success: (totalCrys) => {
                    let width = (totalCrys / wish.crystall) * 100;
                    console.log(totalCrys, wish.crystall, width);

                    $("#topWishMarket").append(`
                    <div class="d-flex justify-content-center align-items-center">
                            <div style="position:relative;width:363px;">
                                <img class="mb-1" width="362px" src="{{ asset('mobile/market/cardd.png') }}"
                                    alt="Image">
                                <div style="position:absolute;top:0;left:0;right:0;bottom:0;">
                                    <div onclick="unsaveWishList(${wish.id})"
                                        style="position: absolute;right:20px;top:90px;width:30px;height:30px;overflow:hidden;text-align:center;border-radius:5px;cursor:pointer"
                                        class="d-flex align-items-center justify-content-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="red" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                                        </svg>
                                    </div>
                                    <div
                                        style="position: absolute;left:21px;top:35px;width:110px;height:110px;overflow:hidden;border-radius:10px">
                                        <div class="d-flex align-items-center justify-content-center"
                                            style="width:100%;height:100%">
                                            <img width="100%" src="${location.protocol + '//' + location.host + "/outermarket/" + wish.image}" alt="WIshlist image">
                                        </div>
                                    </div>
                                    <div
                                        style="position: absolute;right:28px;top:38px;width:204px;height:28px;overflow:hidden;text-align:center;border-radius:5px">
                                        <span style="font-weight: 600;color:#393b65;font-size:13px"
                                            class="supercell">${wish.name}</span>
                                    </div>
                                    <div style="position: absolute;left:10%;top:73%;width:80%;">
                                        <div class="progress" style="height:10px">
                                            <div class="progress-bar bg-primary text-white" role="progressbar"
                                                style="width: ${width}2%" aria-valuenow="25" aria-valuemin="0"
                                                aria-valuemax="100">
                                            </div>
                                        </div>
                                        <div class="text-center" style="height:10px">
                                            <span style="color:black;">${totalCrys}/${wish.crystall}</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center"
                                        style="position: absolute;right:69px;top:81px;width:78px;height:45px;overflow:hidden;text-align:center;border-radius:5px">
                                        <span style="font-weight: 600;color:#393b65;font-size:16px" class="supercell">
                                            ${wish.crystall}
                                        </span>
                                    </div>
                                </div>  
                            </div>
                        </div>
                    `)
                }
            })
        } else {
            $("#topWishMarket").empty()
        }
        $("#wishListItems").empty()
        wishList.forEach(item => {
            console.log(location.protocol + '//' + location.host + "/outermarket/" + item.image);
            document.getElementById("outerMarket" + item.id).style.setProperty('display', 'none', 'important');
            $("#wishListItems").append(`
            <div class="d-flex justify-content-center align-items-center">
                <div style="position:relative;width:95%;padding-right:7px;padding-left:1px">
                    <img class="mb-1" width="100%" src="{{ asset('mobile/market/cardd.png') }}"
                        alt="Image">
                    <div style="position:absolute;top:0;left:0;right:0;bottom:0;">
                        <div onclick="unsaveWishList(${item.id})"
                            style="position: absolute;right:20px;top:90px;width:30px;height:30px;overflow:hidden;text-align:center;border-radius:5px;cursor:pointer"
                            class="d-flex align-items-center justify-content-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="red" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                            </svg>
                        </div>
                        <div
                            style="position: absolute;left:21px;top:35px;width:110px;height:110px;overflow:hidden;border-radius:10px">
                            <div class="d-flex align-items-center justify-content-center"
                                style="width:100%;height:100%">
                                <img width="100%" src="${location.protocol + '//' + location.host + "/outermarket/" + item.image}" alt="WIshlist image">
                            </div>
                        </div>
                        <div
                            style="position: absolute;right:28px;top:38px;width:204px;height:28px;overflow:hidden;text-align:center;border-radius:5px">
                            <span style="font-weight: 600;color:#393b65;font-size:13px"
                                class="supercell">${item.name}</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-center"
                            style="position: absolute;right:69px;top:81px;width:78px;height:45px;overflow:hidden;text-align:center;border-radius:5px">
                            <span style="font-weight: 600;color:#393b65;font-size:16px" class="supercell">
                                ${item.crystall}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            `)
        })
    }
</script>
