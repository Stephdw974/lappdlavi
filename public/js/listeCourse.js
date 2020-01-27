

class listeCourse {

  constructor(CSRF_Token) {
    this.CSRF_Token = CSRF_Token
    console.info('» listeCourse()')
    console.info('» listeCourse() » CSRF_Token : ' + CSRF_Token)
  }




  /**
   * Retourne toutes les listes publiques
   *
   * @memberof listeCourse
   */
  getPublicLists(callback) {
    $.get('/listeCourse/lists/public')
      .done((data) => { callback(JSON.parse(data)) })
      .fail((data) => { console.log(data) })
  }




  /**
 * Retourne toutes les listes privées de l'utilisateur connecté (Traitement en back)
 *
 * @memberof listeCourse
 */
  getPrivateLists(callback) {
    $.get('/listeCourse/lists/private')
      .done(data => { callback(JSON.parse(data)) })
      .fail(data => { console.log(data) })
  }




  /**
 * Retourne toutes les listes de l'utilisateur connecté (Traitement en back)
 *
 * @memberof listeCourse
 */
  getUserLists(callback) {
    $.get('/listeCourse/lists/user')
      .done(data => { callback(JSON.parse(data)) })
      .fail(data => { console.log(data) })
  }



  /**
   * Retourne la liste correspondant à l'ID en parametre
   *
   * @memberof listeCourse
   */

  getList(List_ID, callback) {
    $.get('/listeCourse/list/' + List_ID)
      .done(data => { callback(JSON.parse(data)) })
      .fail(data => { console.log(data) })
  }




  createList(callback) {
    $.post('/listeCourse/list/create', { _token: this.CSRF_Token, name: $('[name="name"]').val() })
      .done(() => { callback() })
      .fail(data => { console.log(data) })
  }




  deleteList(List_ID, callback) {
    $.post('/listeCourse/list/delete/' + List_ID, { _token: this.CSRF_Token })
      .done(() => { callback() })
      .fail(data => { console.log(data) })
  }




  toggleListPrivacy(List_ID, callback) {
    $.post('/listeCourse/list/togglePrivacy/' + List_ID, { _token: this.CSRF_Token })
      .done(() => { callback() })
      .fail(data => { console.log(data) })
  }




  createArticle(List_ID, callback) {
    $.post('/listeCourse/list/' + List_ID + '/createArticle', { _token: this.CSRF_Token, name: $('[name="name"]').val() })
      .done(() => { callback() })
      .fail(data => { console.log(data) })
  }




  deleteArticle(Article_ID, callback) {
    $.post('/listeCourse/article/delete/' + Article_ID, { _token: this.CSRF_Token })
      .done(() => { callback() })
      .fail(data => { console.log(data) })
  }




  toggleArticleState(Article_ID, callback) {
    $.post('/listeCourse/article/toggleState/' + Article_ID, { _token: this.CSRF_Token, name: $('[name="name"]').val() })
      .done(() => { callback() })
      .fail(data => { console.log(data) })
  }
} 