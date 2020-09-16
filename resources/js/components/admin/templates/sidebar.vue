<template>
<div>
    <div class="fixed-left">

        <!-- Logo Part -->
        
             <div class="top-logo">
                <a class="logo hide-menu" href="">
                    <div class="logo-container logo-container-sidebar" style="width: max-content;">
                        <img class="logo-img-sidebar" src="/images/logo.svg" alt="">
                        <h4 class="ml-2 header-logo-side" style="font-weight: bold;">COVIDZ-19</h4>
                    </div>
                </a>
            </div>
            <!-- <div>
                 <button @click="hamb_click" class="btn btn-sm btn-outline-success arrow-menu font-weight-bold">
                        <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-arrow-left font-weight-bold" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                        </svg>
                    </button>
            </div>
             -->
        
        <!-- SideBar-Menu  -->

        <div>
            <ul class="block-menu">
                <router-link to="/admin/home">
                    <li data-toggle="tooltip" data-placement="bottom" title="Dashboard" :class="[currentPage('admin-home') ? activeClass : '', 'menu-item']">
                        <div class="menu-item-container">
                            <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-house-door-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.5 10.995V14.5a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5h-4a.5.5 0 0 1-.5-.5V11c0-.25-.25-.5-.5-.5H7c-.25 0-.5.25-.5.495z"/>
                                <path fill-rule="evenodd" d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                            </svg>
                            <h5 class="ml-3 header-logo-text-sidebar" style="font-weight: bold;">Dashboard</h5>
                        </div>
                    </li>
                </router-link>
                <router-link to="/admin/users">
                    <li data-toggle="tooltip" data-placement="bottom" title="Users" :class="[currentPage('admin-users') ? activeClass : '', 'menu-item']">
                        <div class="menu-item-container">
                            <!-- <img class="logo-img-menu"  src="/images/side-menu-icons/lamp.svg" alt=""> -->
                            <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-people-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
                            </svg>
                            <h5 class="ml-3 header-logo-text-sidebar" style="font-weight: bold;">Users</h5>
                        </div>
                    </li>
                </router-link>
                <router-link to="/ideas">
                    <li data-toggle="tooltip" data-placement="bottom" title="Ideas" :class="[currentPage('Ideas') ? activeClass : '', 'menu-item']">
                        <div class="menu-item-container">

                            <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-gem" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M3.1.7a.5.5 0 0 1 .4-.2h9a.5.5 0 0 1 .4.2l2.976 3.974c.149.185.156.45.01.644L8.4 15.3a.5.5 0 0 1-.8 0L.1 5.3a.5.5 0 0 1 0-.6l3-4zm11.386 3.785l-1.806-2.41-.776 2.413 2.582-.003zm-3.633.004l.961-2.989H4.186l.963 2.995 5.704-.006zM5.47 5.495l5.062-.005L8 13.366 5.47 5.495zm-1.371-.999l-.78-2.422-1.818 2.425 2.598-.003zM1.499 5.5l2.92-.003 2.193 6.82L1.5 5.5zm7.889 6.817l2.194-6.828 2.929-.003-5.123 6.831z"/>
                            </svg>
                            <h5 class="header-logo-text-sidebar ml-3" style="font-weight: bold;">Ideas</h5>
                        </div>
                    </li>
                </router-link>
                <router-link to="/reports" class="">
                    <li data-toggle="tooltip" data-placement="bottom" title="Reports" :class="[currentPage('Reports') ? activeClass : '', 'menu-item']">
                        <div class="menu-item-container">

                            <svg width="1.5625em" height="1.5em" viewBox="0 0 17 16" class="bi bi-exclamation-triangle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.938 2.016a.146.146 0 0 0-.054.057L1.027 13.74a.176.176 0 0 0-.002.183c.016.03.037.05.054.06.015.01.034.017.066.017h13.713a.12.12 0 0 0 .066-.017.163.163 0 0 0 .055-.06.176.176 0 0 0-.003-.183L8.12 2.073a.146.146 0 0 0-.054-.057A.13.13 0 0 0 8.002 2a.13.13 0 0 0-.064.016zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z" />
                                <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z" />
                            </svg>
                            <h5 class="header-logo-text-sidebar ml-3" style="font-weight: bold;">Reports</h5>
                        </div>
                    </li>
                </router-link>
                 <router-link to="/news" class="">
                    <li data-toggle="tooltip" data-placement="bottom" title="News" :class="[currentPage('News') ? activeClass : '', 'menu-item']">
                        <div class="menu-item-container">
                            <!-- <img class="logo-img-menu"  src="/images/side-menu-icons/newsfeed.svg" alt="">-->
                            <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-layout-text-window-reverse" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M2 1h12a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zm12-1a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12z" />
                                <path fill-rule="evenodd" d="M5 15V4H4v11h1zM.5 4h15V3H.5v1zM13 6.5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 .5-.5zm0 3a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 .5-.5zm0 3a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 .5-.5z" />
                            </svg>
                            <h5 class="header-logo-text-sidebar ml-3" style="font-weight: bold;">News</h5>
                        </div>
                    </li>
                </router-link>
                <router-link to="/galery" class="">
                    <li data-toggle="tooltip" data-placement="bottom" title="Galery" :class="[currentPage('Galery') ? activeClass : '', 'menu-item']">
                        <div class="menu-item-container">
                            <!-- <img class="logo-img-menu"  src="/images/side-menu-icons/newsfeed.svg" alt="">-->
                            <svg width="1.5625em" height="1.5em" viewBox="0 0 17 16" class="bi bi-image-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M.002 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2V3zm1 9l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094L15.002 9.5V13a1 1 0 0 1-1 1h-12a1 1 0 0 1-1-1v-1zm5-6.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                            </svg>
                            <h5 class="header-logo-text-sidebar ml-3" style="font-weight: bold;">Galery</h5>
                        </div>
                    </li>
                </router-link>
                <router-link to="/statistics" class="">
                    <li data-toggle="tooltip" data-placement="bottom" title="Statistics" :class="[currentPage('Statistics') ? activeClass : '', 'menu-item']">
                        <div class="menu-item-container">
                            <!-- <img class="logo-img-menu"  src="/images/side-menu-icons/graph.svg" alt=""> -->
                            <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-bar-chart-line" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M11 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h1V7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7h1V2zm1 12h2V2h-2v12zm-3 0V7H7v7h2zm-5 0v-3H2v3h2z" />
                            </svg>
                            <h5 class="ml-3 header-logo-text-sidebar" style="font-weight: bold;">Statistics</h5>
                        </div>
                    </li>
                </router-link>

                <router-link to="/tags">
                    <li data-toggle="tooltip" data-placement="bottom" title="Tags" :class="[currentPage('Tags') ? activeClass : '', 'menu-item']">
                        <div class="menu-item-container">
                            <!-- <img class="logo-img-menu"  src="/images/side-menu-icons/hashtag-half.svg" alt=""> -->
                            <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-tag" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M2 2v4.586l7 7L13.586 9l-7-7H2zM1 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 1 6.586V2z" />
                                <path fill-rule="evenodd" d="M4.5 5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1zm0 1a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                            </svg>
                            <h5 class="ml-3 header-logo-text-sidebar" style="font-weight: bold;">Tags</h5>
                        </div>
                    </li>
                </router-link>
                <router-link to="/categories">
                    <li data-toggle="tooltip" data-placement="bottom" title="Categories" :class="[currentPage('Categories') ? activeClass : '', 'menu-item']">
                        <div class="menu-item-container">
                            <!-- <img class="logo-img-menu"  src="/images/side-menu-icons/bell.svg" alt=""> -->
                            <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-kanban-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M2.5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2h-11zm5 2a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1h-1zm-5 1a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1V3zm9-1a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1h-1z"/>
                            </svg>
                            <h5 class="ml-3 header-logo-text-sidebar" style="font-weight: bold;">Categories</h5>
                        </div>
                    </li>
                </router-link>
                <router-link to="/messages" class="hide-menu">
                    <li data-toggle="tooltip" data-placement="bottom" title="Messages" :class="[currentPage('Messages') ? activeClass : '', 'menu-item']">
                        <div class="menu-item-container">
                            <!-- <img class="logo-img-menu"  src="/images/side-menu-icons/send.svg" alt=""> -->
                            <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-envelope" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383l-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z" />
                            </svg>
                            <h5 class="ml-3 header-logo-text-sidebar" style="font-weight: bold;">Messages</h5>
                        </div>
                    </li>
                </router-link>

                <li class="menu-item humburger-list">

                    <button @click="hamb_click" class="btn hamburger" style="display; none;  padding: 0">
                        <svg viewBox="0 0 100 80" width="1.5em" height="1.5em" fill="currentColor">
                            <rect width="100" height="20" rx="8"></rect>
                            <rect y="30" width="100" height="20" rx="8"></rect>
                            <rect y="60" width="100" height="20" rx="8"></rect>
                        </svg>
                    </button>

                </li>

            </ul>
        </div>
    </div>
    <div id="side-menu" class="dropd-menu" style="display: none;">
        <ul>
            <a class="menu-item-link" href="">
                <li class="menu-item hidden">
                    <div class="menu-item-container">
                        <!-- <img class="logo-img-menu"  src="/images/side-menu-icons/hashtag-half.svg" alt=""> -->
                        <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z" />
                            <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z" />
                        </svg>
                        <h5 class="ml-3" style="font-weight: bold;">Explore</h5>
                    </div>
                </li>
            </a>

            <a class="menu-item-link " href="">
                <li class="menu-item hidden">
                    <div class="menu-item-container">
                        <!-- <img class="logo-img-menu"  src="/images/side-menu-icons/send.svg" alt=""> -->
                        <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-envelope" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383l-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z" />
                        </svg>
                        <h5 class="ml-3" style="font-weight: bold;">Messages</h5>
                    </div>
                </li>
            </a>
            <a class="menu-item-link " href="">
                <li class="menu-item hidden">
                    <div class="menu-item-container">
                        <!-- <img class="logo-img-menu"  src="/images/side-menu-icons/bookmark.svg" alt=""> -->
                        <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-bookmark" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z" />
                        </svg>
                        <h5 class="ml-3" style="font-weight: bold;">Bookmarks</h5>
                    </div>
                </li>
            </a>
            <a class="menu-item-link " href="">
                <li class="menu-item hidden">
                    <div class="menu-item-container">
                        <!-- <img class="logo-img-menu"  src="/images/side-menu-icons/bookmark.svg" alt=""> -->
                        <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                        </svg>
                        <h5 class="ml-3" style="font-weight: bold;">Profile</h5>
                    </div>
                </li>
            </a>
            <a class="menu-item-link " href="/logout" @click="logout">
                <li class="menu-item hidden">
                    <div class="menu-item-container">
                        <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-door-open-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M1.5 15a.5.5 0 0 0 0 1h13a.5.5 0 0 0 0-1H13V2.5A1.5 1.5 0 0 0 11.5 1H11V.5a.5.5 0 0 0-.57-.495l-7 1A.5.5 0 0 0 3 1.5V15H1.5zM11 2v13h1V2.5a.5.5 0 0 0-.5-.5H11zm-2.5 8c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z" />
                        </svg>
                        <h5 class="ml-3" style="font-weight: bold;">LogOut</h5>
                    </div>
                </li>
            </a>

        </ul>
    </div>
</div>
</template>

<style scoped>
    .block-menu, .logo-container-sidebar {
        padding-inline-start: 5px;
    }
    .logo-container-sidebar {
        margin:auto;
        width: max-content;
    }
    .top-logo {
        padding: 10px;
        margin-bottom: 10%;
    }
</style>>

</style>

<script>
export default {

    data: function () {
        return {
            activeClass: 'active',
        }
    },

    mounted() {

    },
    computed: {
        route(){
            return this.$route.path;
        }
    },
    methods: {
        hamb_click() {
            let e = document.querySelector("#side-menu");
            let v = document.querySelector('div.main-wall');

            if (e.style.display == 'none') {
                e.style.display = 'block';
                v.style.filter = "blur(8px)";
            } else {
                e.style.display = 'none';
                v.style.filter = "blur(0px)"
            }
        },
        logout() {
            document.getElementById('logout-form').submit();
        },
        currentPage(slug){
            return this.$route.name.includes(slug);
        }
    }
}
</script>