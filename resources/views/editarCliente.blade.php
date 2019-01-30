@extends('layout.app',["current"=> "clientes"])

@section('body')


  <main role="main">
    <div class="row">
      <div class="container  col-sm-8 offset-md-2">

        <div class="card border">
          <div class="card-header">
            <h5 class="card-title">Cadastro de Cliente</h5>
          </div>
          <div class="card-body">
             <form action="/clientes/{{$cli->id}}" method="post">
                          
              <input type="hidden" name="_token" value="{{ csrf_token() }}">

              <input type="hidden" id='idCliente' name="idCliente" value="{{$cli->nome}}" >

              <div class="form-group">
                <label for="nome">Nome do Cliente</label>
                <input type="text" class="form-control  {{$errors->has('nome') ? 'is-invalid' : ''}} " name="nome" value="{{$cli->nome}}" id="nome" placeholder="Nome do Cliente">
              </div>

<?php if ($errors->has('nome')): ?>
      <div class="invalid-feedback">
        {{$errors->first('nome')}}
      </div>
<?php endif; ?>

              <div class="form-group">
                <label for="idade">Idade do Cliente</label>
                <input type="number" class="form-control" name="idade" value="{{$cli->idade}}" id="idade" placeholder="Idade do Cliente">
              </div>

              <?php if ($errors->has('idade')): ?>
                    <div class="invalid-feedback">
                      {{$errors->first('idade')}}
                    </div>
              <?php endif; ?>

              <div class="form-group">
                <label for="endereco">Endereço do Cliente</label>
                <input type="text" class="form-control" name="endereco" value="{{$cli->endereco}}" id="endereco" placeholder="Endereço do Cliente">
              </div>

              <?php if ($errors->has('endereco')): ?>
                    <div class="invalid-feedback">
                      {{$errors->first('endereco')}}
                    </div>
              <?php endif; ?>

              <div class="form-group">
                <label for="endereco">Email</label>
<!--
                <input type="email" class="form-control" name="email"  id="email" placeholder="E-mail do Cliente">
-->
                <input type="text" class="form-control" name="email" value="{{$cli->email}}"  id="email" placeholder="E-mail do Cliente">
              </div>

              <?php if ($errors->has('email')): ?>
                    <div class="invalid-feedback">
                      {{$errors->first('email')}}
                    </div>
              <?php endif; ?>


              <button type="submit" class="btn btn-primary btn-sn">Editar</button>
              <button type="cancel" class="btn btn-danger btn-sn">Cancelar</button>
            </form>
          </div>
  <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>

</body>
</html>

@endsection
