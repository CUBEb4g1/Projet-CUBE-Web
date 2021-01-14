<form action="" id="recherche" class="w-100 flex-nowrap">
    <div class="input-group ml-auto mr-auto justify-content-center">
        <input type="text" class="form-control col-12 col-xl-8 w-100" placeholder="{{ $placeholder }}" aria-describedby="basic-addon1" value="{{ $value }}" id="searchable" name="query">
        <div class="input-group-postpend">
            <button type="submit" class="btn mt-2 mt-lg-0" style="background-color: #093467; color: white">
                <i class="far fa-search fa-fw"></i> Lancer la recherche
            </button>
        </div>
    </div>
</form>
