<!-- Modal -->
<div class="modal fade" id="baseModal" tabindex="-1" role="dialog" aria-labelledby="ModalCenter" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <form action="{{strtolower($action)}}" method="POST" enctype="multipart/form-data" class='w-100'>
      @csrf
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalCenter">{{$modal_hearder}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @isset($method)
            @method($method)
        @endisset
        <table class='m-auto'>
          @isset($modal_body)
            @foreach ($modal_body as $row)
                <tr>
                  <td class='text-right'>{{$row['label']}}</td>
                  <td>
                    @switch($row['tag'])
                        @case('input')
                            @include('layout.input',$row)
                            @break
                        @case('textarea')
                            @break
                        @case('img')
                             @include('layout.img',$row)
                            @break
                    @endswitch
                  </td>
                </tr>
            @endforeach
          @endisset
          {{--  <tr>
            <td>標題圖片</td>
            <td>@include('layout.input',["type"=>"file","name"=>'img'])</td>
          </tr>
          <tr>
            <td>標題區替代文字</td>
            <td><input type="text" name="text"></td>
          </tr>  --}}
        </table>
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-secondary" >重置</button>
        <button type="submit" class="btn btn-primary">儲存</button>
      </div>
    </div>
  </form>
  </div>
</div>