@extends('layout')
@section('assets')
<link rel="stylesheet" href="css/noticiaspage.css">
@endsection
@section('content')
<section class="conteudo-internas">
	<div class="centraliza">
		<div class="conteudo-esquerda">
			<div class="lista">
				<!--Lista de Noticias-->
				<div class="form-group row col-12 busca">
					<input type="text"  class="form-control col-8" placeholder="Digite sua busca" id="searchInput">
					<button class="btn btn-primary col-2" id="submitBtn"> Buscar </button>
				</div>
				<!--Fim Paginação-->
			</div>
			<!--Fim Lista de Noticias-->
			<ul class="pagination" id="pagination"></ul>
		</div>
		<!-- final conteudo-esquerda -->
	</div>
	<!-- final centraliza -->
</section>
@endsection
@section('script')
<script>
	$(document).ready(function () {
	        var $pagination = $('#pagination');
	        var result = [];
	        var totalPages = 0,page = 1;
	        var displayRecords = [];
	        var recPerPage = 5;
	        var proxyUrl = 'https://cors-anywhere.herokuapp.com/',
	         url = 'http://www.marcha.cnm.org.br/webservice/noticias';
	         monName = new Array("Janeiro",
	                        "Fevereiro",
	                        "Março",
	                        "Abril",
	                        "Maio",
	                        "Junho",
	                        "Julho",
	                        "Agosto",
	                        "Setembro",
	                        "Outubro",
	                        "Novembro",
	                        "Dezembro");
	          var semana = ["Domingo", "Segunda-Feira", "Terça-Feira", "Quarta-Feira", "Quinta-Feira", "Sexta-Feira", "Sábado"];
	
	     $("#submitBtn").on('click',function(){
        $.blockUI({ 
            message: 'Por Favor Espere!', 
            timeout: 2000 
        });       
	        result = [];
	        page = 1;
	        query = $("#searchInput").val();
	        $.ajax({
              type:"GET",
              url: ''+proxyUrl + url+'',
              data: {pesquisa: query},
              success: function(json) {
                result = json.noticias;
                totalPages = Math.ceil(result.length/5);
                if($('#pagination').data("twbs-pagination"))
                  $('#pagination').twbsPagination('destroy');
                  apply_pagination(); 
              }
	      });
	    });
      $.blockUI({ 
            message: 'Por Favor Espere!', 
            timeout: 2000 
        }); 
	    fetch(proxyUrl + url).then(res => res.json())
	    .then(json => {
	      result = json.noticias;
	      totalPages = Math.ceil(result.length/5);
	      if($('#pagination').data("twbs-pagination"))
	        $('#pagination').twbsPagination('destroy');
	      apply_pagination();
	    });
	
	    function apply_pagination(){
	      $pagination.twbsPagination({
	            totalPages: totalPages,
	            visiblePages: 6,
	            onPageClick: function (event, page) {
	                  $('.classeRemover').remove();
	                  displayRecordsIndex = Math.max(page - 1, 0) * recPerPage;
	                  endRec = (displayRecordsIndex) + recPerPage;
	                 
	                  displayRecords = result.slice(displayRecordsIndex, endRec);
	                  generateNews();
	            }
	      });
	    }
	
	    function generateNews(){
	      $.each(displayRecords, function(index) {
	            var arr = displayRecords[index].data_formatada.split("/").reverse();
	            data = new Date(arr[0], arr[1] - 1, arr[2]);
	            $('<article>',{
                id:'noticia'+index+'',
                class:'box-noticia classeRemover'
              }).appendTo('.lista');
	            $('<a>',{
                href:''+displayRecords[index].url+'',
                id:'link'+index+''
              }).appendTo('#noticia'+index+'');
	            $('<figure>',{
                id:'media'+index+''
              }).appendTo('#link'+index+'');
	            $('<img>',{
                src:''+displayRecords[index].imagem+''
              }).appendTo('#media'+index+'');
              $('<div>',{
                id:'noticdiv'+index+'',
                 class:'texto-lista-noticias'
              }).appendTo('#link'+index+'');
	            $('<span/>', {		    
			         class: 'data-lista-noticia',
	             text: ''+semana[data.getDay()]+' , '+data.getUTCDate()+' de '+monName[data.getMonth()]+' de '+data.getUTCFullYear()+'',
	            }).appendTo('#noticdiv'+index+'');
	            $('<H1/>', {		    
	             text: ''+displayRecords[index].titulo+'',
	            }).appendTo('#noticdiv'+index+'');
	            $('<p/>', {
	              id: 'texto'+index+'',		    
	             text: ''+displayRecords[index].texto.replace(/<\/?[^>]+>/gi, '').substring(0, 320)+"..."+'',
	            }).appendTo('#noticdiv'+index+'');    		
	            $('<hr>',{class:'classeRemover'}).appendTo('.lista');	           
          });
          $.unblockUI; 
      }
		}); 
</script>
@endsection