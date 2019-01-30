@extends('layout.app',["current"=> "produtos"])

@section('body')
<div class="card border">
  <div class="card-body">
    <h5 class="card-title">Cadastro de Produtos</h5>

    <table class="table table-ordered table-hover">
      <thead>
      <tr>
        <th>Código</th>
        <th>Nome</td>
        <th>Quantidade</th>
        <th>Preço</th>
        <th>Departamento</th>
        <th>Ações</th>
      </tr>
      </thead>

      <tbody>

      </tbody>

    </table>
  </div>

  <div class="card-footer">
      <button class="btn btn-sn btn-primary" role="button" onclick="">Novo produto </a>
  </div>

</div>



<div class="model" tabindex="-1" role="dialog" id="dlgProdutos">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form class="form-horizontal" id="formProduto">
        <div class="modal-header">
          <h5 class="modal-title"> Novo Produto </h5>
        </div>

        <div class="modal-body">
          <input type="hidden" id="id" class="form-control">
          <div class="input-group">
             <input type="text"  class="form-control" id="nomeProduto" placeholder="Nome do Produto" >
          </div>
        </div>


    </div>
  </div>
</div>



@endsection
