

class listes {

  constructor(CSRF_Token) {
    this.CSRF_Token = CSRF_Token
    console.info('» listes()')
    console.info('» listes() » CSRF_Token : ' + CSRF_Token)
  }




  /**
   * Retourne toutes les listes publiques
   *
   * @memberof listes
   */
  getPublicLists(callback) {
    $.get('/listes/lists/public')
      .done((data) => { callback(JSON.parse(data)) })
      .fail((data) => { console.log(data) })
  }




  /**
 * Retourne toutes les listes privées de l'utilisateur connecté (Traitement en back)
 *
 * @memberof listes
 */
  getPrivateLists(callback) {
    $.get('/listes/lists/private')
      .done(data => { callback(JSON.parse(data)) })
      .fail(data => { console.log(data) })
  }




  /**
 * Retourne toutes les listes de l'utilisateur connecté (Traitement en back)
 *
 * @memberof listes
 */
  getUserLists(callback) {
    $.get('/listes/lists/user')
      .done(data => { callback(JSON.parse(data)) })
      .fail(data => { console.log(data) })
  }



  /**
   * Retourne la liste correspondant à l'ID en parametre
   *
   * @memberof listes
   */

  getList(List_ID, callback) {
    $.get('/listes/list/' + List_ID)
      .done(data => { callback(JSON.parse(data)) })
      .fail(data => { console.log(data) })
  }




  createList(callback) {
    $.post('/listes/list/create', { _token: this.CSRF_Token, name: $('[name="name"]').val() })
      .done(() => { callback() })
      .fail(data => { console.log(data) })
  }




  deleteList(List_ID, callback) {
    $.post('/listes/list/delete/' + List_ID, { _token: this.CSRF_Token })
      .done(() => { callback() })
      .fail(data => { console.log(data) })
  }




  toggleListPrivacy(List_ID, callback) {
    $.post('/listes/list/togglePrivacy/' + List_ID, { _token: this.CSRF_Token })
      .done(() => { callback() })
      .fail(data => { console.log(data) })
  }




  createArticle(List_ID, callback) {
    $.post('/listes/list/' + List_ID + '/createArticle', { _token: this.CSRF_Token, name: $('[name="name"]').val() })
      .done(() => { callback() })
      .fail(data => { console.log(data) })
  }




  deleteArticle(Article_ID, callback) {
    $.post('/listes/article/delete/' + Article_ID, { _token: this.CSRF_Token })
      .done(() => { callback() })
      .fail(data => { console.log(data) })
  }




  toggleArticleState(Article_ID, callback) {
    $.post('/listes/article/toggleState/' + Article_ID, { _token: this.CSRF_Token, name: $('[name="name"]').val() })
      .done(() => { callback() })
      .fail(data => { console.log(data) })
  }
} 