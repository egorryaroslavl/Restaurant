<?php
    if( !isset( $data->table ) || empty( $data->table ) ){
        die( 'Ошибка!' );
    };

    $all_list         = [];
    $selected_list    = [];
    $selected_id_list = [];
    if( isset( $data->id ) ){

        $selected_id_list_json = DB::table( $data->table )
                ->select( 'related' )
                ->where( 'id', $data->id )
                ->first()->related;


        if( !empty( $selected_id_list_json ) && $selected_id_list_json != '"null"' ){
            $selected_id_list = json_decode( $selected_id_list_json );


            $selected_list = DB::table( $data->table )
                    ->whereIn( 'id', $selected_id_list )
                    ->get();
            /*    dd($selected_list);*/
        }
    }


    $all_list = DB::table( $data->table )
            ->select( 'id', 'name' )
            ->whereNotIn( 'id', $selected_id_list )
            ->whereNotIn( 'id', [$data->id])
            ->get();

?>
<div class="row">
    <div class="col-xs-5 all-wrap">
        <table class="table table-hover all" id="all">
            <thead>
            <tr>
                <th>Не привязанные</th>
            </tr>
            </thead>
            <tbody>
            @if(count($all_list)>0)
                @foreach($all_list as $item)
                    <tr class="all" data-id="{{$item->id}}" id="all_{{$item->id}}">
                        <td>{{$item->name}}
                            <input type="hidden" name="all[]" value="{{$item->id}}">
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
    <div class="col-xs-1"
         style="background:url(/_admin/img/arrows-revers-24.png)50% 50% no-repeat;background-size: contain; height:20rem;"></div>
    <div class="col-xs-5 related-wrap">
        <table class="table table-hover related" id="related">
            <thead>
            <tr>
                <th>Привязанные</th>
            </tr>
            </thead>
            <tbody>
            @if( count( $selected_list ) > 0 )
                @foreach( $selected_list as $item )
                    <tr class="related" data-id="{{$item->id}}" id="related_{{$item->id}}">
                        <td>{{$item->name}}
                            <input type="hidden" name="related[]" value="{{$item->id}}">
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>

    </div>
</div>

<style>
    table.all td, table.related td {
        cursor:              pointer;
        -webkit-user-select: none;
        -moz-user-select:    none;
        -ms-user-select:     none;
        user-select:         none;
        }
</style>