<div class="container h-70">
    <style>
        @media only screen and (min-width: 350px) {
    
            .chat-body {
                height: 60vh;
                overflow: hidden;
            }
    
            .chat-messages {
                display: flex;
                flex-direction: column;
                height: 100%;
                background: #cbdbe1;
                overflow-y: scroll
            }
    
            body {
                margin-top: 20px;
            }
    
            .chat-message-left {
            display: flex;
            flex-shrink: 0
            }

            .chat-message-left {
                margin-right: auto
            }
            .chat-message-right {
                display: flex;
                flex-shrink: 0
            }
    
            .chat-message-right {
                flex-direction: row-reverse;
                margin-left: auto
            }
            .messageImage {
                width: 90vw;
            }
            .messageImage img {
                width: 90%;
            }
        }
    </style>
    <div class="">
        
        <select class="form-control" wire:change="selectPatient($event.target.value)">
            <option value="" selected disabled>Mijoz tanlang</option>
            @foreach ($clients as $client)
                <option value="{{$client->id}}">{{$client->name}}</option>
            @endforeach
        </select>

        @if ($messages)
        <div class="card w-100vh">
            <div>
                <div>
                    {{-- <div class="py-2 px-4 border-bottom d-none d-lg-block">
                        <div class="d-flex align-items-center py-1">
                            <div class="position-relative">
                                <div class="rounded-circle mr-1 bg-secondary" style="width: 40px;height:40px">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png"
                                        class="rounded-circle mr-1" width="40" height="40">
                                </div>
                            </div>
                            <div class="mr-1">
                                <strong>DDDDD</strong>
                            </div>
                        </div>
                    </div> --}}
                    <div class="position-relative">
                        <div class="chat-body">
                            <div class="chat-messages">
                                @foreach ($messages as $message)
                                    @php
                                            if($message->wiriter_id == $message->client_id){
                                                $classname = 'chat-message-right';
                                                $image_link = $link.'/'.$message->image;
                                            }else{
                                                $classname = 'chat-message-left';
                                                $image_link = asset('mijoz/message/'.$message->image);
                                            }
                                    @endphp
                                    <div class=" {{$classname}} pb-4">
                                        <div>
                                            <img src="https://bootdey.com/img/Content/avatar/avatar1.png"
                                                class="rounded-circle mr-1" alt="Chris Wood" width="40"
                                                height="40">
                                        </div>
                                        <div class="flex-shrink-1 bg-light rounded px-2 text-end" style="color:black" >
                                            <div class="text-start font-weight-bold mb-1">
                                                {{ $message->message }}
                                            </div>
                                            @isset($message->image)

                                            <div class="btn" data-toggle="modal" data-target="#exampleModal{{ $message->id }}">
                                                    <img width="100" class=""
                                                        src="{{$image_link}}"
                                                        alt="Message image">
                                                    <div class="modal fade" id="exampleModal{{ $message->id }}" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content d-flex justify-content-center align-items-center">
                                                                <div class="messageImage">
                                                                    <img
                                                                    src="{{$image_link}}"
                                                                    alt="Message image">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                            @endisset

                                            <div class="text-end">
                                                <div class="text-muted small text-nowrap mt-2">
                                                    {{ date('d.m.Y H:i', strtotime($message->created_at)) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="send-message flex-grow-0 py-3 px-4 border-top">
                        <form action="{{route('mijoz.message')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group">
                                <label for="upload_file" class="btn btn-success">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-cloud-upload" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383z" />
                                        <path fill-rule="evenodd"
                                            d="M7.646 4.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V14.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3z" />
                                    </svg>
                                </label>
                                <input type="file" name="image" class="d-none" id="upload_file">
                                <input type="text" class="d-none" value="{{ $message->chat_id }}" name="chat_id">
                                <input type="text" class="d-none" value="{{ $message->client_id }}" name="client_id">
                                <input type="text" class="d-none" value="{{ $message->user_id }}"
                                    name="tg_user_id">
                                <input type="text" name="message" class="form-control"
                                    placeholder="Xabar qoldiring ...">
                                <button class="btn btn-primary">Jo'natish</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div
        @endif

    </div>

</div>
