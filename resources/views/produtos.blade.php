@extends('layout.app',["current"=> "produtos"])

@section('body')
<div class="card border">
  <div class="card-body">
    <h5 class="card-title">Cadastro de Produtos</h5>

    <table class="table table-ordered table-hover" id="tabelaProdutos">
      <thead>
      <tr>
        <th>Código</th>
        <th>Nome</td>
        <th>Preço</th>
        <th>Quantidade</th>
        <th>Departamento</th>
        <th>Ações</th>
      </tr>
      </thead>

      <tbody>

      </tbody>

    </table>
  </div>

  <div class="card-footer">
      <button class="btn btn-sm btn-primary" role="button" onclick="novoProduto()">Novo produto </button>
  </div>

</div>



<div class="modal" tabindex="-1" role="dialog" id="dlgProdutos">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-horizontal" id="formProduto">
                <div class="modal-header">
                    <h5 class="modal-title">Novo produto</h5>
                </div>
                <div class="modal-body">

                    <input type="hidden" id="id" class="form-control">
                    <div class="form-group">
                        <label for="nomeProduto" class="control-label">Nome do Produto</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="nomeProduto" placeholder="Nome do produto">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="precoProduto" class="control-label">Preço</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="precoProduto" placeholder="Preço do produto">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="quantidadeProduto" class="control-label">Quantidade</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="quantidadeProduto" placeholder="Quantidade do produto">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="categoriaProduto" class="control-label">Categoria</label>
                        <div class="input-group">
                            <select class="form-control" id="categoriaProduto" >
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection




@section('javascript')

<script type="text/javascript">


$.ajaxSetup({ //AJAX com o token CSRF para o formulário
    headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
    }
});

    function novoProduto() {
      $('#id').val('');                //função para zerar todos os campos preenchidos e mostrar o modal com o formulário
      $('#nomeProduto').val('');
      $('#precoProduto').val('');
      $('#quantidadeProduto').val('');
      $('#dlgProdutos').modal('show');  //mostra formulário
    }

    function carregarCategorias(){
      $.getJSON('/api/categorias',function(data){          //função para mostrar todas as categorias cadastradas no select do formulário
        for(i=0;i<data.length;i++){
          opcao= '<option value= "' + data[i].id + '">' + data[i].nome + '</option>';
          $('#categoriaProduto').append(opcao);  //seta categoria no select do formulário
        }
      });
    }

    function montarLinha(p){
      var linha = "<tr>" +
        "<td>" + p.id + "</td>" +
        "<td>" + p.nome + "</td>" +
        "<td>" + p.preco + "</td>" +
        "<td>" + p.estoque + "</td>" +
        "<td>" + p.categoria_id + "</td>" +
        "<td>" +
        '<button class="btn btn-sm btn-primary"  onclick="editar(' + p.id + ')"> Editar  </button>' +          //montando cada linha da tabela e retornando
        '<button class="btn btn-sm btn-danger"  onclick="apagar(' + p.id + ')">  Apagar </button>' +
        "</td>"
        "</tr>"
        return linha;
    }

    function carregarProdutos(){
      $.getJSON('/api/produtos',function(produtos){  //chamando a api e retornando json e recebendo na variável produtos
          for(i=0;i<produtos.length;i++){
              linha = montarLinha(produtos[i]);
              $('#tabelaProdutos>tbody').append(linha); //mostrando a linha na tabela
          }
      });
    }

    function criarProduto() {
        prod = {
            nome: $("#nomeProduto").val(),
            preco: $("#precoProduto").val(),                  //pega os valores digitados do novo produto
            estoque: $("#quantidadeProduto").val(),
            categoria_id: $("#categoriaProduto").val()
        };
        $.post("/api/produtos", prod, function(data) {    //envia esse novo produto (prod) para salvar
            produto = JSON.parse(data);  //transforma o JSON em produto
            linha = montarLinha(produto); //monta a linha com as informações do novo produto.
            $('#tabelaProdutos>tbody').append(linha); //coloca nova linha na tabela
        });
    }

    function editar(id) {
        $.getJSON('/api/produtos/'+id, function(data) {
            console.log(data);
            $('#id').val(data.id);                 //função retornando todos os dados do produto para editar e populando campos do formulário.
            $('#nomeProduto').val(data.nome);
            $('#precoProduto').val(data.preco);
            $('#quantidadeProduto').val(data.estoque);
            $('#categoriaProduto').val(data.categoria_id);
            $('#dlgProdutos').modal('show');  //mostra formulário
        });
    }

    function apagar(id) {
        $.ajax({
            type: "DELETE",
            url: "/api/produtos/" + id,  //envia id para apagar produto referente
            context: this,
            success: function() {
                console.log('Apagou OK');
                linhas = $("#tabelaProdutos>tbody>tr");     //pega referência para a primeira coluna com os ids
                e = linhas.filter( function(i, elemento) {
                    return elemento.cells[0].textContent == id;  //encontra a linha que foi apagada passando o id dela.
                });
                if (e)
                    e.remove();  //remove a linha
            },
            error: function(error) {
                console.log(error);  //se der erro entra aqui
            }
        });
    }


    function salvarProduto() {
        prod = {
            id : $("#id").val(),
            nome: $("#nomeProduto").val(),
            preco: $("#precoProduto").val(),              //update do produto, pegando valores dos campos do formulário
            estoque: $("#quantidadeProduto").val(),
            categoria_id: $("#categoriaProduto").val()
        };
        $.ajax({
            type: "PUT",
            url: "/api/produtos/" + prod.id,    //enviando id do produto para encontrar o produto.
            context: this,
            data: prod,
            success: function(data) {
                prod = JSON.parse(data);
                linhas = $("#tabelaProdutos>tbody>tr");
                e = linhas.filter( function(i, e) {
                    return ( e.cells[0].textContent == prod.id );
                });
                if (e) {
                    e[0].cells[0].textContent = prod.id;
                    e[0].cells[1].textContent = prod.nome;
                    e[0].cells[2].textContent = prod.estoque;
                    e[0].cells[3].textContent = prod.preco;
                    e[0].cells[4].textContent = prod.categoria_id;
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    $("#formProduto").submit( function(event){        //pega evento submit do formulário
        event.preventDefault();
        if ($("#id").val() != '')
            salvarProduto();           // se id do formulário for diferente de zero vai para editar
        else
            criarProduto();           // se for id nulo vai para criar produto

        $("#dlgProdutos").modal('hide');      //esconde o modal.
    });

    $(function(){
      carregarCategorias();       //chamando as funções
      carregarProdutos();
    })


</script>

@endsection
