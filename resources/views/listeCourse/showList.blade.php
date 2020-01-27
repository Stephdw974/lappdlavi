@extends('layouts.app')
@section('page_name', 'Default')

@section('content')

<div class="container mb-3">
  <div class="btn-group">
    <a href="#" action="goBack" class="btn btn-dark">
      <i class="fas fa-angle-double-left mr-2"></i> Retour
    </a>
  </div>
  <div class="btn-group float-right">
    <a href="#" action="deleteList" class="btn btn-dark"><i class="fas fa-trash"></i></a>
    <a href="#" action="editList" class="btn btn-dark"><i class="fas fa-pen"></i></a>
    <a href="#" action="lockList" class="btn btn-dark"><i class="fas fa-lock"></i></a>
  </div>
</div>
<div class="container">
  <b id="deletionMode" style="display:none">Mode suppression activé</b>
  <div id="listeCourse"></div>

</div>

<div class="fixed-bottom border-top py-2 bg-white">
  <div class="container">
    <input type="text" class="form-control rounded-0" name="name" placeholder="Ajouter un article...">
  </div>
</div>

@endsection


@section('js')
<script src="{{ asset('js/lappdlavi.js') }}"></script>
<script src="{{ asset('js/listeCourse.js') }}"></script>
<script>
  window.onload = () => {

    var LC = new listeCourse('{{ csrf_token() }}')
    var LC_ID = $(location).attr('pathname').split('/')[2]


    const setList = () => {
      LC.getList(LC_ID, (data) => {
        console.log(data)


        if (data['list'].is_private == 1) {
          $('#appname').text('Liste privée "' + data['list'].name + '"')
          $('[action="lockList"]').html('<i class="fas fa-lock-open"></i>')
        } else {
          $('#appname').text('Liste publique "' + data['list'].name + '"')
          $('[action="lockList"]').html('<i class="fas fa-lock"></i>')
        }

        $('#listeCourse').html(null)
        Object.keys(data['articles']).forEach(i => {
          $('#listeCourse').prepend('<div article="' + data['articles'][i].id + '" action="toggleArticleState" class="isBuyed' + data['articles'][i].is_buyed + '">' + data['articles'][i].name + '</div>')
        })
      })
    }
    setList()


    $('[name="name"]').on('keyup', (e) => {
      if (e.which == 13) {
        LC.createArticle(LC_ID, () => {
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
  #listeCourse {
    border: 1px solid #bababa;
    border-radius: 5px;
    background: rgb(254, 254, 254);
  }

  #listeCourse div {
    border-bottom: 1px solid #bababa;
    cursor: pointer;
    text-align: justify;

    font-size: 16px;
    padding: 8px 16px 8px 16px;
  }

  #listeCourse div:last-child {
    border-bottom: none;
  }

  #listeCourse div:hover {
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