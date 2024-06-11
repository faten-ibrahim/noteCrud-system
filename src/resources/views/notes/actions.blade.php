
<a href="/notes/{{$row->id}}/edit" class="btn btn-sm btn-success " data-id="{{$row->id}}"><i class="fa fa-edit"></i><span>Edit</span></a>

<form method="POST" style="display: inline;" action="notes/{{$row->id}}">@csrf {{ method_field('
                   DELETE ')}}<button type="submit" onclick=" confirm('Are you sure you want to delete this note\?');" class="btn btn-sm btn-danger">
                   <i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Delete"></i><span>Delete</span></button></form>

