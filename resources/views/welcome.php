{{extends=layouts.app}}

{{var=title:'Home'}}

{{section=content}}

<div class="container">
    <div class="row p-5">
        <div class="col-md-12">        
            <h1 class="text-orange"><?=config('app.name')?>GQL</h1>
            <p>
                Uma modificação do framework <b>MVC</b> com <b>com zero dependencias</b>.<br />
                Agora com suporte ao GraphQL.
            </p>
        </div>
    </div>
</div>

{{endsection}}