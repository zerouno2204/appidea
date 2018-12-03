<header class="demo-header mdl-layout__header mdl-color--red-800 mdl-color-text--grey-50 is-casting-shadow">
    <div role="button" tabindex="0" class="mdl-layout__drawer-button">
        <i class="material-icons"></i>
    </div>
    <div class="mdl-layout__header-row">        
        <span class="mdl-layout-title" style=" text-transform: capitalize; ">                  
                @lang('global.global_title')            
        </span>            
        <div class="mdl-layout-spacer"></div>
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable is-upgraded" data-upgraded=",MaterialTextfield">
            
        </div>
        <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="hdrbtn" data-upgraded=",MaterialButton,MaterialRipple">
            {{ strtoupper(\App::getLocale()) }}
            <span class="mdl-button__ripple-container"><span class="mdl-ripple"></span></span></button>
        <div class="mdl-menu__container is-upgraded"><div class="mdl-menu__outline mdl-menu--bottom-right"></div><ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right mdl-js-ripple-effect--ignore-events" for="hdrbtn" data-upgraded=",MaterialMenu,MaterialRipple">
                @foreach(config('app.languages') as $short => $title)
                <li class="mdl-menu__item mdl-js-ripple-effect" tabindex="-1" data-upgraded=",MaterialRipple">
                    <a href="{{ route('admin.language', $short) }}">
                        {{ $title }} ({{ strtoupper($short) }})
                    </a>
                    <span class="mdl-menu__item-ripple-container"><span class="mdl-ripple"></span></span>
                </li>
                @endforeach
            </ul></div>
    </div>
</header>

<style>
    .slimScrollDiv {
        width: auto !important;
        height:auto !important;
    }

    .language-menu {
        width: auto !important;
        list-style-type: none;
        padding: 0;
        margin: 0;
        max-width: 300px;
        height:auto !important;
        max-height: 500px !important;
    }

    .language-link {
        width: auto;
    }

    .language-link a {
        display: block;
        width: 100%;
        white-space: normal !important;
        padding: 5px;
    }
    .language-link a:hover {
        color: #389ad2;
        background: #f9f9f9;
    }
</style>

