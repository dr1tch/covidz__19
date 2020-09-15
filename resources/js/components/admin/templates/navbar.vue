<template>
<div>
    <nav class="flex justify-content-between align-items-center mb-3">
        <!-- Logo Part -->
        <!-- <div class="flex justify-content-between align-items-center top-logo"> -->

            <!-- <div style="margin-right: 13%;">
                 <button @click="hamb_click" class="btn btn-sm btn-outline-success arrow-menu font-weight-bold">
                        <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-arrow-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                        </svg>
                    </button>
            </div> -->

            <div class="top-logo">
                <a class="logo hide-menu" href="">
                    <div class="logo-container logo-container-sidebar" style="width: max-content;">
                        <img class="logo-img-sidebar" src="/images/logo.svg" alt="">
                        <h4 class="ml-2 header-logo-side" style="font-weight: bold;">COVIDZ-19</h4>
                    </div>
                </a>
            </div>

            <!-- </div>
        <div></div> -->
            <div>
                <form class="search-bar" method="POST" action="">
                    <div class="full-width">
                        <div class="flex btn-group">
                            <button class="btn btn-dark">
                                <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi bi-search text-light" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z" />
                                    <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z" />
                                </svg>
                            </button>
                            <input id="search" type="text" class="form-control px-3 py-2 bg-dark border-0 shadow-none text-light" name="search" required autocomplete="search" placeholder="Search">
                            <span class="invalid-feedback" role="alert"></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="dropdown">
                <button class="btn btn-sm btn-outline-success rounded-lg dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-gear-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 0 0-5.86 2.929 2.929 0 0 0 0 5.858z" />
                    </svg>
                    Settings
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" @click="logout">Log Out</a>
                    <form style="display: hidden" action="/logout" method="POST" id="logout">
                        <input type="hidden" name="_token" :value="csrf_token" />
                    </form>
                    <!-- <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a> -->
                </div>
            </div>
        <!-- </div> -->
    </nav>
</div>
</template>

<style scoped>
nav {
    padding: 10px 0;
    /* margin: auto 9%; */
}

.logo-container-sidebar {
    padding-inline-start: 5px;
}

.logo-container-sidebar {
    margin: auto;
    width: max-content;
}

.top-logo {
    padding: 10px 0;
}
</style>

<script>
export default {

}
</script>
