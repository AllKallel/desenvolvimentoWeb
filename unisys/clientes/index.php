<!DOCTYPE html>
<html lang="en">
<head>
<title>Produtos</title>
<meta charset="utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>  

<script type="text/javascript" src="js/jquery-ui-1.8.17.custom/js/jquery-1.7.1.min.js"></script>

<link rel="stylesheet" href="js/jquery-ui-1.8.17.custom/css/smoothness/jquery-ui-1.8.17.custom.css">
<script src="js/jquery-ui-1.8.17.custom/development-bundle/ui/jquery.ui.core.js" type="text/javascript"></script>
<script src="js/jquery-ui-1.8.17.custom/development-bundle/ui/jquery.ui.widget.js" type="text/javascript"></script> 
<script src="js/jquery-ui-1.8.17.custom/development-bundle/ui/jquery.ui.button.js" type="text/javascript"></script>
<script src="js/jquery-ui-1.8.17.custom/development-bundle/ui/jquery.ui.datepicker.js" type="text/javascript"></script> 

<script type="text/javascript" src="js/jquery.form.js"></script>

<script src="js/jquery.jqGrid-3.8.2/js/i18n/grid.locale-pt-br.js" type="text/javascript"></script>
<script src="js/jquery.jqGrid-3.8.2/js/jquery.jqGrid.min.js" type="text/javascript"></script>
<link href="js/jquery.jqGrid-3.8.2/css/ui.jqgrid.css" rel="stylesheet" type="text/css"/>


<script>
$(function() {
	jQuery("#clientesGrid").jqGrid({
			url:'ajaxListarClientes.php',
			datatype:'json',
            mtype:'GET',
            jsonReader:
				{'repeatitems':false},
            pager:'#clientesPagerGrid',
            rowNum:10,
            rowList:
				[10,20,30,40,50,60,70,80,90,100],
            sortable:true,
            viewrecords:true,
            gridview:true,
            autowidth:true,
            height:370,
            shrinkToFit:true,
            forceFit:true,
            hidegrid:false,
            sortname:'Nomecliente',
            sortorder:'asc',
			caption: "Clientes",
            colModel:[
                {label:'Cód.',width:60,align:'center',name:'idCliente'},
				{label:'Nome do Cliente',width:400,align:'left',name:'nomeCliente'},
				{label:'Cpf',width:300,align:'left',name:'cpf'},
				{label:'Telefone',width:200,align:'center',name:'telefone'},
				{label:'Sexo',width:200,align:'center',name:'sexo'}
            ] 
        });
	jQuery("#clientesGrid").jqGrid('navGrid', '#clientesPagerGrid', {del:false,add:false,edit:false,search:false,refresh:true} );
	
	//cadastro de clientes
	$("#btnCadastrar").click(function(){
		window.location = "clientesCad.php";				   
	})
	
	//editar de clientes
	$("#btnEditar").click(function(){
		var linhaSelecionada = jQuery("#clientesGrid").getGridParam('selrow');
		
		var id = jQuery("#clientesGrid").getCell(linhaSelecionada,0);
			
		if(id != false){
			window.location = "clienteEdit.php?id="+id;				
		}else{
			alert("Nenhum cliente foi selecionado!");
		}	   
	})
	
	//deletar de clientes
	$("#btnDeletar").click(function(){
	
		var linhaSelecionada = jQuery("#clientesGrid").getGridParam('selrow');

		var id = jQuery("#clientesGrid").getCell(linhaSelecionada,0);
		
		if(id != false){
			
			if (confirm("Confirma a exclusão?") == true){
			
				$('#objetoQualquer').load('clienteAction.php?acao=delete&id='+id);

				//var txtNome = $('#txtNomeCategoria').val();	
		
				jQuery("#clientesGrid").jqGrid('setGridParam',{url:'ajaxListarClientes.php',page:1}).trigger('reloadGrid');
			}	
		}else{
			alert("Selecione um Registro");
		}			   
	})
	
	//pesquisa
	jQuery("#btnPesquisar").click(function(){
		var txtNome = $('#txtNomeCliente').val();	
		
		jQuery("#clientesGrid").jqGrid('setGridParam',{url:'ajaxListarClientes.php?txtNomeCliente='+txtNome ,page:1}).trigger('reloadGrid');
		
	})
	
	//Limpar pesquisa de clientes
	jQuery("#btnLimpar").click(function(){	
		$('#txtNomeCliente').val('');			
		jQuery("#produtosGrid").jqGrid('setGridParam',{url:'ajaxListarClientes.php' ,page:1}).trigger('reloadGrid');		
	})
});
</script>
</head>
<body>
<div id="botoes" style="padding:4px 4px 4px 4px; color:#666; font-size:12px; font-weight:bold;">
    <input type="button" id="btnCadastrar" value="Cadastrar"/>
    <input type="button" id="btnEditar" value="Editar"/>
    <input type="button" id="btnDeletar" value="Deletar"/>
    <input type="text" id="txtNomeCliente" name="txtNomeCliente"/> 
    <input type="button" id="btnPesquisar" value="Pesquisar"/>  
    <input type="button" id="btnLimpar" value="Limpar"/>
	
</div> 
<table id="clientesGrid" ></table>
<div id="clientesPagerGrid"></div>
<div id="objetoQualquer"></div>
</body>
</html>