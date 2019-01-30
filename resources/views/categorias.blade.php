@extends('layout.app',["current"=> "categorias"])

@section('body')
  <div class="card border">
    <div class="card-body">
      <h5 class="card-title">Cadastro de Categorias</h5>

<?php if (count($categorias) > 0): ?>
      <table class="table table-ordered table-hover">
        <thead>
        <tr>
          <th>Código</th>
          <th>Nome da Categoria</td>
          <th>Ações</th>
        </tr>
        </thead>
<?php foreach ($categorias as $categoria): ?>
    <tr>
        <td> {{$categoria->id}} </td>
        <td> {{$categoria->nome}} </td>
        <td>
          <a href="/categorias/editar/{{$categoria->id}}" class="btn btn-sn btn-primary"> Editar </a>
          <a href="/categorias/apagar/{{$categoria->id}}" class="btn btn-sn btn-danger"> Excluir </a>
       </td>
    </tr>
<?php endforeach; ?>
      </table>
<?php endif; ?>
    </div>

    <div class="card-footer">
        <a href="/categorias/novo" class="btn btn-sn btn-primary" role="button">Nova Categoria </a>
    </div>

  </div>
@endsection
