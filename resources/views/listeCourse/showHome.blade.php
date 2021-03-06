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
    <a href="#" action="showPublicList" class="btn btn-dark border-secondary"><i class="fas fa-users"></i></a>
    <a href="#" action="showPrivateList" class="btn btn-dark border-secondary"><i class="fas fa-user"></i></a>
  </div>
</div>

<div class="container">

  <div id="listes" class="text-dark"></div>

</div>

<div class="fixed-bottom py-2 bg-rb">
  <div class="container">

    <input type="text" class="form-control rounded-0" name="name" placeholder="Créer une nouvelle liste.." autocomplete="off">

  </div>
</div>

@endsection


@section('js')
<script src="{{ asset('js/listes.js') }}"></script>
<script>
  window.onload = () => {


    var LC = new listes('{{ csrf_token() }}')

    const setList = (privacy) => {
      if (privacy === 'public') {
        $('#appname').text('Listes partagées')
        LC.getPublicLists((data) => {
          console.log(data)
          $('#listes').html(null)
          Object.keys(data).forEach(i => {
            $('#listes').prepend('<div list="' + data[i].id + '" action="joinList" class="' + data[i].id + '">' + data[i].name + '</div>')
          })
        })
      } else if (privacy === 'private') {
        $('#appname').text('Listes personnelles')
        LC.getPrivateLists((data) => {
          console.log(data)
          $('#listes').html(null)
          Object.keys(data).forEach(i => {
            $('#listes').prepend('<div list="' + data[i].id + '" action="joinList" class="' + data[i].id + '">' + data[i].name + '</div>')
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
      $(location).attr('href', '/listes/' + $(this).attr('list'))
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
  #listes {
    border: 1px solid #bababa;
    border-radius: 5px;
    background: rgb(254, 254, 254);
    color: rgb(75, 75, 75) !important;
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
    background: rgb(240, 240, 240);
  }
</style>

@endsection