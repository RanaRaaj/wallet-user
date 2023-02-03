<span class="dropdown option_list">
<button id="btnSearchDrop{{$exist->id}}" type="button"
        class="btn btn-sm btn-icon btn-pure font-medium-2 table-drop-menu" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="ft-more-vertical"></i>
    </button>
    <span aria-labelledby="btnSearchDrop{{$exist->id}}" class="dropdown-menu mt-1 dropdown-menu-right"
          x-placement="bottom-end"
          style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(55px, 27px, 0px);">
{{--            <a href="{{isset($view)?$view:"#"}}"--}}
{{--               class="dropdown-item" title="View the record.">--}}
{{--                <i class="ft-eye"></i>--}}
{{--                View--}}
{{--            </a>--}}
            @if($exist->status == 1)
                <form action="{{isset($status)?$status:"#"}}" method="post">
                    @method('PUT')
                    @csrf
                    <input type="hidden" value="0" name="status">
                    <a href="javascript:void(0);" class="dropdown-item inactive status_option"
                       title="Click to make inactive the active value">
                         <i class="ft-plus-circle primary"></i>Inactive</a>
                </form>
            @else
                <form action="{{isset($status)?$status:"#"}}" method="post">
                    @method('PUT')
                    @csrf
                    <input type="hidden" value="1" name="status">
                    <a href="javascript:void(0);" class="dropdown-item active status_option"
                       title="Click to make inactive the active value"
                       style="background-color: #ffffff; color: black">
                         <i class="ft-plus-circle primary"></i> Active</a>
                </form>
            @endif
        <a href="{{isset($edit)?$edit:"#"}}" class="dropdown-item edit edit_option" title="Edit the value">
            <i class="ft-edit-2"></i> Edit</a>

        <form action="{{isset($delete)?$delete:"#"}}" method="post">
            <input type="hidden" name="_method" value="DELETE">
                @csrf
            <a href="javascript:void(0);" class="dropdown-item delete delete_option"
               title="Danger! this action will delete the record from database">
                 <i class="ft-trash-2"></i> Delete</a>
        </form>
    </span>
</span>
