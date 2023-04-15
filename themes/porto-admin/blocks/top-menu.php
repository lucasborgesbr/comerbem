<span class="separator"></span>

<div id="userbox" class="userbox">
    <a href="#" data-toggle="dropdown">
        <!--<figure class="profile-picture">
            <img src="<?= theme("img/clients/client-1.jpg"); ?>" alt="Joseph Doe" class="rounded-circle" data-lock-picture="img/!logged-user.jpg" />
        </figure>-->
        <div class="profile-info" data-lock-name="<?=user()->nome?>" data-lock-email="<?=user()->email?>">
            <span class="name"><?= user()->nome?></span>
        </div>

        <i class="fa custom-caret"></i>
    </a>

    <div class="dropdown-menu">
        <ul class="list-unstyled mb-2">
            <li class="divider"></li>
            <li>
                <a role="menuitem" tabindex="-1" href="<?=url("/app/profile")?>"><i class="fas fa-user"></i> Minha Conta</a>
            </li>
            <li>
                <a role="menuitem" tabindex="-1" title="logout" href="<?=url("/app/logout")?>"><i class="fas fa-power-off"></i> Sair</a>
            </li>
            <!--
            <li class="divider"></li>
            <li style="text-align: center">
                <a href="#" onclick="doGTranslate('pt|en');return false;" title="English" class="gflag nturl" style="background-position:-0px -0px;"><img src="//gtranslate.net/flags/blank.png" height="24" width="24" alt="English" /></a><a href="#" onclick="doGTranslate('pt|pt');return false;" title="Portuguese" class="gflag nturl" style="background-position:-300px -200px;"><img src="//gtranslate.net/flags/blank.png" height="24" width="24" alt="Portuguese" /></a><a href="#" onclick="doGTranslate('pt|es');return false;" title="Spanish" class="gflag nturl" style="background-position:-600px -200px;"><img src="//gtranslate.net/flags/blank.png" height="24" width="24" alt="Spanish" /></a>
                <style type="text/css">

                    a.gflag {
                        display: inline !important;
                        vertical-align:middle;
                        background-repeat:no-repeat;
                        background-image:url(<?= theme("img/flags-24a.png") ?>);
                    }
                    a.gflag img {border:0;}
                    a.gflag:hover {background-image:url(<?= theme("img/flags-24a.png") ?>);}
                    #goog-gt-tt {display:none !important;}
                    .goog-te-banner-frame {display:none !important;}
                    .goog-te-menu-value:hover {text-decoration:none !important;}
                    body {top:0 !important;}
                    #google_translate_element2 {display:none!important;}

                </style>

                <div id="google_translate_element2"></div>
                <script type="text/javascript">
                    function googleTranslateElementInit2() {new google.translate.TranslateElement({pageLanguage: 'en',autoDisplay: false}, 'google_translate_element2');}
                </script><script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit2"></script>


                <script type="text/javascript">
                    /* <![CDATA[ */
                    eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('6 7(a,b){n{4(2.9){3 c=2.9("o");c.p(b,f,f);a.q(c)}g{3 c=2.r();a.s(\'t\'+b,c)}}u(e){}}6 h(a){4(a.8)a=a.8;4(a==\'\')v;3 b=a.w(\'|\')[1];3 c;3 d=2.x(\'y\');z(3 i=0;i<d.5;i++)4(d[i].A==\'B-C-D\')c=d[i];4(2.j(\'k\')==E||2.j(\'k\').l.5==0||c.5==0||c.l.5==0){F(6(){h(a)},G)}g{c.8=b;7(c,\'m\');7(c,\'m\')}}',43,43,'||document|var|if|length|function|GTranslateFireEvent|value|createEvent||||||true|else|doGTranslate||getElementById|google_translate_element2|innerHTML|change|try|HTMLEvents|initEvent|dispatchEvent|createEventObject|fireEvent|on|catch|return|split|getElementsByTagName|select|for|className|goog|te|combo|null|setTimeout|500'.split('|'),0,{}))
                    /* ]]> */
                </script>
            </li> -->
        </ul>
    </div>
</div>