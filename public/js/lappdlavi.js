$(() => {
  $('body').on('click', '[action="goBack"]', function (e) {
    e.preventDefault()
    $(location).attr('pathname', $(location).attr('pathname').split('/').slice(0, -1).join('/'))
  })
})