@extends('layout.app',["current"=> "clientes"])

@section('body')
  <div class="card border">
    <div class="card-body">
      <h5 class="card-title">Cadastro de Clientes</h5>

<?php if (count($clientes) > 0): ?>
      <table class="table table-ordered table-hover">
        <thead>
        <tr>
          <th>Código</th>
          <th>Nome</td>
          <th>Idade</th>
          <th>Email</th>
          <th>Endereço</th>
        </tr>
        </thead>
<?php foreach ($clientes as $cli): ?>
    <tr>
        <td> {{$cli->id}} </td>
        <td> {{$cli->nome}} </td>
        <td> {{$cli->idade}} </td>
        <td> {{$cli->email}} </td>
        <td> {{$cli->endereco}} </td>
        <td>
          <a href="/clientes/editar/{{$cli->id}}" class="btn btn-sn btn-primary"> Editar </a>
          <a href="/clientes/apagar/{{$cli->id}}" class="btn btn-sn btn-danger"> Excluir </a>
       </td>
    </tr>
<?php endforeach; ?>
      </table>
<?php endif; ?>
    </div>

    <div class="card-footer">
        <a href="/clientes/novo" class="btn btn-sn btn-primary" role="button">Novo cliente </a>
    </div>

  </div>
@endsection
