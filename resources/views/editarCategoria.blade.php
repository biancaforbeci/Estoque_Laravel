@extends('layout.app',["current"=> "categorias"])

@section('body')

<div class="card border">
  <div class="card-body">
     <form class="form-horizontal" method="post" action="/categorias/{{$cat->id}}">
    @csrf  <!--//sem ele não consegue salvar nada via post. -->
      <div class="form-group">
          <input type="hidden" id='idCategoria' name="idCategoria" value="{{$cat->id}}"
          <label for="nomeCategoria">Nome da Categoria</label>
          <input type="text" class="form-control" name="nomeCategoria" id="nomeCategoria"value="{{$cat->nome}}" placeholder="Categoria" >
      </div>
        <button type="submit" class="btn btn-primary btn-sn">Editar</button>
       <button type="cancel" class="btn btn-danger btn-sn">Cancelar</button>
    </form>
  </div>
</div>

@endsection
