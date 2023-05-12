@php
    use App\Helpers\Template as Template;
    use App\Helpers\Hightlight as Hightlight;
@endphp
<div class="x_content">
    <div class="table-responsive">
        <table class="table table-striped jambo_table bulk_action">
            <thead>
                <tr class="headings">
                    <th class="column-title">#</th>
                    <th class="column-title">Name</th>
                    <th class="column-title">Trạng thái</th>
                    <th class="column-title">Loại Open</th>
                    <th class="column-title">Loại Menu</th>
                    <th class="column-title">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @if (count($items) > 0)
                    @foreach ($items as $key => $val)
                        @php
                            $index           = $key + 1;
                            $class           = ($index % 2 == 0) ? "even" : "odd";
                            $id              = $val['id'];
                            $name            = Hightlight::show($val['name'], $params['search'], 'name');
                            $link            = Hightlight::show($val['link'], $params['search'], 'link');
                            $status          = Template::showItemStatus($controllerName, $id, $val['status']); 
                            $type_open       = Template::showItemSelect($controllerName, $id, $val['type_open'], 'type_open');
                            $type_menu       = Template::showItemSelect($controllerName, $id, $val['type_menu'], 'type_menu');
                            $listBtnAction   = Template::showButtonAction($controllerName, $id);
                        @endphp

                        <tr class="{{ $class }} pointer">
                            <td >{{ $index }}</td>
                            <td width="30%">
                                <p><strong>Name:</strong> {!! $name !!}</p>
                                <p><strong>Link:</strong> {!! $link !!}</p>
                            </td>
                            <td>{!! $status !!}</td>
                            
                            <td>{!! $type_open   !!}</td>
                            <td>{!! $type_menu   !!}</td>
                            <td class="last">{!! $listBtnAction !!}</td>
                        </tr>
                    @endforeach
                @else
                    @include('admin.templates.list_empty', ['colspan' => 6])
                @endif
            </tbody>
        </table>
    </div>
</div>
           