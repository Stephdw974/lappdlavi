@extends('layouts.app')
@section('page_name', 'Default')

@section('content')

<div class="container mb-3">
  <div class="btn-group">
    <a href="#" action="goBack" class="btn btn-dark border-secondary">
      <i class="fas fa-angle-double-left mr-2"></i> Retour
    </a>
  </div>
  <div class="btn-group float-right">
    <a href="#" data-toggle="modal" data-target="#deleteList" class="btn btn-dark border-secondary"><i class="fas fa-trash"></i></a>
    <a href="#" action="editList" class="btn btn-dark border-secondary"><i class="fas fa-pen"></i></a>
    <a href="#" action="lockList" class="btn btn-dark border-secondary"><i class="fas fa-lock"></i></a>
  </div>
</div>
<div class="container">
  <b id="deletionMode" class="alert alert-info" style="display:none">Mode suppression activé</b>

  <div class="progress mb-3">
  <!-- <div class="progress-bar" role="progressbar" style="width: '+progress+'%;" aria-valuenow="'+progress+'" aria-valuemin="0" aria-valuemax="100"></div> -->
  </div>
  <div id="listes"></div>
</div>

<div class="fixed-bottom py-2 bg-rb">
  <div class="container">
    <input type="text" class="form-control rounded-0" name="name" placeholder="Ajouter un item..." autocomplete="off">
  </div>
</div>


<div class="modal fade" id="deleteList" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content p-3 text-dark text-center">
      <b>Es-tu sûr(e) de vouloir supprimer cette liste ?</b>
      <hr>
      <div class="btn-group">
        <button action="deleteList" class="btn btn-danger w-100">Oui</button>
        <button onclick="$('#deleteList').modal('hide')" class="btn btn-dark w-100">Non</button>
      </div>
    </div>
  </div>
</div>
@endsection


@section('js')
<script src="{{ asset('js/lappdlavi.js') }}"></script>
<script src="{{ asset('js/listes.js') }}"></script>
<script>
  window.onload = () => {

    var LC = new listes('{{ csrf_token() }}')
    var LC_ID = $(location).attr('pathname').split('/')[2]


    const setList = () => {
      LC.getList(LC_ID, (data) => {
        console.log(data)

        checked_val = 0

        Object.keys(data['articles']).forEach(i => {
          if(data['articles'][i].is_buyed == 1)  checked_val++
        })

        progress = (checked_val/data['articles'].length) * 100
        console.log(progress)
        $('.progress').html(null)
        $('.progress').append('<div class="progress-bar" role="progressbar" style="width: '+progress+'%;" aria-valuenow="'+progress+'" aria-valuemin="0" aria-valuemax="100">'+checked_val+' / '+data['articles'].length+'</div>')

        $('#appname').text(data['list'].name)
        if (data['list'].is_private == 1) {
          $('[action="lockList"]').html('<i class="fas fa-lock-open"></i>')
        } else {
          $('[action="lockList"]').html('<i class="fas fa-lock"></i>')
        }

        $('#listes').html(null)
        Object.keys(data['articles']).forEach(i => {
          $('#listes').prepend('<div article="' + data['articles'][i].id + '" action="toggleArticleState" class="isBuyed' + data['articles'][i].is_buyed + '">' + data['articles'][i].name + '</div>')
        })
      })
    }
    setList()

    setInterval(() => {
      setList()
    }, 2500)

    $('[name="name"]').on('keyup', (e) => {
      if (e.which == 13) {
        LC.createArticle(LC_ID, () => {
          $('[name="name"]').val('')
          setList()
        })
      }
    })


    $('body').on('click', '[action="toggleArticleState"]', function(e) {
      e.preventDefault()
      if ($('[action="editList"]').hasClass('active')) {
        LC.deleteArticle($(this).attr('article'), () => {
          setList()
        })
      } else {
        LC.toggleArticleState($(this).attr('article'), () => {
          setList()
        })
      }
    })

    $('body').on('click', '[action="deleteList"]', function(e) {
      e.preventDefault()
      LC.deleteList(LC_ID, () => {
        $('[action="goBack"]').click()
      })
    })

    $('body').on('click', '[action="lockList"]', function(e) {
      e.preventDefault()
      LC.toggleListPrivacy(LC_ID, () => {
        setList()
      })
    })

    $('body').on('click', '[action="editList"]', function(e) {
      e.preventDefault()
      $(this).toggleClass('active')
      $('#deletionMode').toggle()
    })


  }
</script>

@endsection


@section('css')

<style>
  #listes {
    border: 1px solid #bababa;
    border-radius: 5px;
    background: rgb(254, 254, 254);
  }

  #listes div {
    border-bottom: 1px solid #bababa;
    cursor: pointer;
    text-align: justify;

    font-size: 16px;
    padding: 8px 16px 8px 16px;
  }

  #listes div:last-child {
    border-bottom: none;
  }

  #listes div:hover {
    background: rgb(250, 250, 250);
  }

  .isBuyed0 {
    color: rgb(75, 75, 75);
    text-decoration: none;
  }

  .isBuyed1 {
    color: rgb(175, 175, 175);
    text-decoration: line-through;
  }
</style>

@endsection