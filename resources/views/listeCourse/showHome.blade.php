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
    <a href="#" action="showPublicList" class="btn btn-dark"><i class="fas fa-users"></i></a>
    <a href="#" action="showPrivateList" class="btn btn-dark"><i class="fas fa-user"></i></a>
  </div>
</div>

<div class="container">

  <div id="listeCourse"></div>

</div>

<div class="fixed-bottom border-top py-2 bg-white">
  <div class="container">

    <input type="text" class="form-control rounded-0" name="name" placeholder="Créer une nouvelle liste.." autocomplete="off">

  </div>
</div>

@endsection


@section('js')
<script src="{{ asset('js/listeCourse.js') }}"></script>
<script>
  window.onload = () => {

    var LC = new listeCourse('{{ csrf_token() }}')

    const setList = (privacy) => {
      if (privacy === 'public') {
        $('#appname').text('Listes de course partagées')
        LC.getPublicLists((data) => {
          console.log(data)
          $('#listeCourse').html(null)
          Object.keys(data).forEach(i => {
            $('#listeCourse').prepend('<div list="' + data[i].id + '" action="joinList" class="' + data[i].id + '">' + data[i].name + '</div>')
          })
        })
      } else if (privacy === 'private') {
        $('#appname').text('Listes de course privées')
        LC.getUserLists((data) => {
          console.log(data)
          $('#listeCourse').html(null)
          Object.keys(data).forEach(i => {
            $('#listeCourse').prepend('<div list="' + data[i].id + '" action="joinList" class="' + data[i].id + '">' + data[i].name + '</div>')
          })
        })
      }
    }


    setList('public')

    $('[name="name"]').on('keyup', (e) => {
      if (e.which == 13) {
        LC.createList(() => {
          $('[name="name"]').val('')
          setList('public')
        })
      }
    })
    $('body').on('click', '[action="joinList"]', function(e) {
      e.preventDefault()
      $(location).attr('href', '/listeCourse/' + $(this).attr('list'))
    })
    $('body').on('click', '[action="showPublicList"]', function(e) {
      e.preventDefault()
      setList('public')
    })
    $('body').on('click', '[action="showPrivateList"]', function(e) {
      e.preventDefault()
      setList('private')
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
    background: rgb(240, 240, 240);
  }
</style>

@endsection