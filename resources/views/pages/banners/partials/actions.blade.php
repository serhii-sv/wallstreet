<div class="invoice-action">
    <a href="{{ route('banners.edit', $banner->id) }}" data-position="bottom" data-tooltip="Изменить"
       class="invoice-action-view mr-4 tooltipped">
        <i class="material-icons">edit</i>
    </a>
    <a href="{{ route('banners.destroy', $banner->id) }}" data-position="bottom" data-tooltip="Удалить"
       class="invoice-action-view mr-4 tooltipped delete">
        <i class="material-icons">delete</i>
    </a>
</div>
