<footer>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <!-- website logo -->
                <img class="img-responsive" src="../assets/img/LOGO_JUSTFORYOU.png" alt="">
            </div>
            <div class="col-sm-4">
                <ul class="footer-list">
                    @if(count($urls) > 0 && count($menus) > 0)
                      @foreach($menus as $menu)
                        @foreach($urls as $url)
                          {{-- to footer menus --}}
                          @if($url->position === 2 && $menu->id === 2)
                          <li class="footer-item">
                              <a href="../{{$url->slug}}" title="{{$url->title}}" class="footer-link">{{$url->title}}</a>
                          </li>
                          @endif
                        @endforeach
                      @endforeach
                    @endif
                </ul>
            </div>
            <div class="col-sm-4">
                <h4>Subscreva a nossa newsletter</h4>
                <small>Subscreve para seres dos primeiros a receber as novidades da
                    <strong>Just FOR YOU</strong>
                </small>
                <form action="{{url('subscribe')}}" method="post" class="form validate-form inputs--inline clearfix">
                    <div class="form-field">
                        <input type="email" class="required-email form-control" placeholder="exemplo@email.com" name="email_newsletter"
                            id="email_newsletter">
                    </div>
                    @csrf
                    <button type="submit" class="btn btn-primary fright">Subscrever</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <br>
                <small>&copy;
                    <?= date('Y'); ?> Todos os direitos reservados</small>
            </div>
        </div>
    </div>
</footer>