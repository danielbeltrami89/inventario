@extends('layouts.app')

@section('content')

  <!-- Início CardTable -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
    <h1 class="h3 text-gray-800 float-left">Locais</h1>
      <a class="btn btn-primary float-right" href="{{ route('novo_local') }}" role="button">Adicionar local</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Id</th>
              <th>Nome</th>
              <th>Endereço</th>
              <th>Cidade</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Id</th>
              <th>Nome</th>
              <th>Endereço</th>
              <th>Cidade</th>
              <th>Ações</th>
            </tr>
          </tfoot>
          <tbody>
          @foreach($locais as $local)
            <tr>
              <td><a href="{{ route('ver_local', ['local_id' => $local->id ]) }}">{{ $local->id }}</a></td>
              <td>{{ $local->nome }}</td>
              <td>{{ $local->endereco }}</td>
              <td>{{ $local->cidade }}</td>
              <td style="text-align:center">                        
                  <a href="{{ route('ver_local', ['local_id' => $local->id ]) }}"><i class="fas fa-edit"></i></a>
                  <a href="javascript:;" data-toggle="modal" onclick="deleteData({{ $local->id }})" data-target="#deleteModal"><i class="fas fa-trash-alt"></i></a>
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- Fim CardTable -->

  <!-- Início Modal -->
  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Excluir?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Deseja realmente excluir o item <b><span id="mod-id"></span></b>? Essa ação não pode ser desfeita.</p>
        </div>
        <div class="modal-footer">
          <form action="" id="deleteForm" method="post">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>          
              {{ csrf_field() }}
              {{ method_field('POST') }}
            <button type="submit" name="" class="btn btn-danger" data-dismiss="modal" onclick="formSubmit()">Sim, excluir</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  
  <script type="text/javascript">
     function deleteData(id) {
         var id = id;
         var url = '{{ route("deletar_local", ":id") }}';
         url = url.replace(':id', id);
         $("#deleteForm").attr('action', url);
         document.getElementById("mod-id").innerHTML = id;
     }

     function formSubmit() {
         $("#deleteForm").submit();
     }
  </script>
  <!-- Fim Modal -->

@endsection