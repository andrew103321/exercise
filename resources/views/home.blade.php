    @extends('layout.layout')
    @section('main')
        <div class="menu col-3">
            <div class="text-center py-2 border-bottom my-1">主選單區</div>
            @isset($menus)
                <ul class="list-group">
                    @foreach ($menus as $menu)
                         <li class="list-group-item list-group-item-action py-1 bg-warning menu">
                             <a href="{{$menu->href}}" >{{$menu->text}}</a>
                             @isset($menu->subs)
                                <ul class="list_group position-absolute w-75 subs" style="left:100px; z-index:99; display:none;">
                                     @foreach ($menu->subs as $sub)
                                        <li class="list-group-item list-group-item-action bg-success py-1 "><a href="{{$sub->href}}">{{$sub->text}}</a></li>
                                     @endforeach
                                </ul>
                            @endisset
                            </li>
                    @endforeach
                </ul>
            @endisset
        </div>
        <div class="main col-6">
            @yield('center')
        </div>
        <div class="right col-3">
            <buttom class="btn btn-primary  py-3  w-100">管理登入</buttom>
            <div class="text-center py-2 border-bottom my-1">主選單區</div>
            <div class="up"> </div>
                @isset($images)
                    @foreach ($images as $img)
                        <div class='img'><img src="{{'storage/'.$img->img}}" alt=""></div>
                    @endforeach
                @endisset
           
            <div class="down">

            </div>
        </div>
        @endsection

    @section('script')
        <script>
          $(".menu").hover(
              function(){  
                $(this).children('.subs').show()
              },
              function(){  
                $(this).children('.subs').hide()
              }
          )

          let num = $(".img").length;
          console.log(num)
          let p = 0;
        $(".img").each((idx,dom)=>{
                if(idx<3){
                    $(dom).show()
                }
        })

        $(".up,.down").on("click",function(){
           $('.img').hide();
            switch($(this).attr("class")){
                case 'up':
                    p = (0>p)?--p:p;
                break
                case 'down':
                   p=(p<=num-3)?++p:p;
                break
            }

            $(".img").each((idx,dom)=>{
                if(idx>=p && idx<=p+2)
                    $(dom).show()
            })
        })
    
        </script>
    @endsection