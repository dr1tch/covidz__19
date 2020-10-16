<template>
<div class="m-0 p-0">
    <!-- Add Ideas Modal -->
    <modal name="add-idea-modal" height="auto" width="600px" classes="text-light bg-secondary">
        <div>

            <div class="card">
                <div class="card-header">
                    <h4 class="font-weight-bold">Add Idea</h4>
                </div>
                <form @change="clear($event.target.name)" action="/ideas/create" method="POST" @submit.prevent="addIdea" @keyup="clear($event.target.name)">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" class=" form-control bg-secondary text-light mb-3" placeholder="Title ..." v-model="title">
                                <span class=" alert-sm text-sm text-danger" v-if="errors.title" v-text="errors.title[0]"></span>
                            </div>
                            <div class="col-md-6">
                                <select @change="clear($event.target.name)" name="category" v-model="category" id="" class="form-control bg-secondary text-light mb-3">
                                    <option value="" selected disabled>Category...</option>
                                    <option v-for="category in $store.state.categories" :key="category.id" :value="category.id">{{category.name}}</option>
                                </select>
                                <span class=" help text-sm text-danger" v-if="errors.category" v-text="errors.category[0]"></span>
                            </div>

                        </div>
                        <div>
                            <textarea type="text" class=" form-control bg-secondary text-light mb-3" placeholder="Body ..." v-model="body"></textarea>
                            <span class=" alert-sm text-sm text-danger" v-if="errors.body" v-text="errors.body[0]"></span>
                        </div>
                        <div class="flex justify-content-between align-items-center p-2">
                            <button type="button" class="btn" data-toggle="tooltip" data-placement="bottom" title="Select a Cover Image">
                                <label for="path" class="flex" style="margin-bottom: 0;">
                                    <div>
                                        <svg width="1.5625em" height="1.5em" viewBox="0 0 17 16" class="bi bi-image-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M.002 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2V3zm1 9l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094L15.002 9.5V13a1 1 0 0 1-1 1h-12a1 1 0 0 1-1-1v-1zm5-6.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                        </svg>
                                    </div>
                                </label>
                            </button>
                            <input type="file" name="path" id="path" @change="newCover" style="display: none;">
                            <img :src="imgPreview" alt="" class="img-preview img-fluid rounded-lg" width="100px">
                        </div>
                        <span class=" alert-sm text-sm text-danger" v-if="errors.image" v-text="errors.image[0]"></span>
                    </div>
                    <div class="card-footer">
                        <div class="flex align-items-center justify-content-between">
                            <button type="button" @click="$modal.hide('add-idea-modal')" class="btn btn-sm btn-danger">Cancel</button>
                            <button type="submit" class="btn btn-sm btn-success" :disabled="any(errors)">Add</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </modal>
    <!-- Add Reports Modal -->
    <modal name="add-report-modal" height="auto" width="750px" classes="text-light bg-secondary">
        <div>

            <div class="card">
                <div class="card-header">
                    <h4 class="font-weight-bold">Report Something</h4>
                </div>
                <form action="/reports/create" method="POST" @submit.prevent="addReport">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" class=" form-control bg-secondary text-light mb-3" placeholder="Title ..." v-model="title">
                                <!-- <span class=" alert text-danger" v-if="errors" v-text="form.errors.errors.errors.tagName[0]"></span> -->
                            </div>
                            <div class="col-md-6">
                                <select name="" v-model="category" id="" class="form-control bg-secondary text-light mb-3">
                                    <option value="" selected disabled>Category...</option>
                                    <option v-for="category in $store.state.categories" :key="category.id" :value="category.id">{{category.name}}</option>
                                </select>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <select name="" v-model="wilaya" id="" class="form-control bg-secondary text-light mb-3">
                                    <option value="" selected disabled>Willaya...</option>
                                    <option v-for="wilaya in $store.state.wilayas" :key="wilaya.id" :value="wilaya.id">{{wilaya.name}}</option>
                                </select>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class=" form-control bg-secondary text-light mb-3" placeholder="Address ..." v-model="address">
                                <!-- <span class=" alert text-danger" v-if="errors" v-text="form.errors.errors.errors.tagName[0]"></span> -->
                            </div>

                        </div>
                        <div class="row">
                            <textarea type="text" class=" form-control bg-secondary text-light mb-3 mx-3" placeholder="Body ..." v-model="body"></textarea>
                            <!-- <span class=" alert text-danger" v-if="errors" v-text="form.errors.errors.errors.tagName[0]"></span> -->
                        </div>
                        <div class="flex justify-content-between align-items-center p-2">
                            <button type="button" class="btn" data-toggle="tooltip" data-placement="bottom" title="Select a Cover Image">
                                <label for="path" class="flex" style="margin-bottom: 0;">
                                    <div>
                                        <svg width="1.5625em" height="1.5em" viewBox="0 0 17 16" class="bi bi-image-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M.002 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2V3zm1 9l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094L15.002 9.5V13a1 1 0 0 1-1 1h-12a1 1 0 0 1-1-1v-1zm5-6.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                        </svg>
                                    </div>
                                </label>
                            </button>
                            <input type="file" name="path" id="path" @change="newCover" style="display: none;">
                            <img :src="imgPreview" alt="" class="img-preview rounded-lg" width="150px">
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="flex align-items-center justify-content-between">
                            <button type="button" @click="$modal.hide('add-report-modal')" class="btn btn-sm btn-danger">Cancel</button>
                            <button type="submit" class="btn btn-sm btn-success">Add</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </modal>
    <div class="fixed-left">

        <!-- Logo Part -->
        <a class="logo hide-menu" href="">
            <div class="logo-container logo-container-sidebar">
                <img class="logo-img-sidebar" src="/images/logo.svg" alt="">
                <h4 class="ml-2 header-logo-side" style="font-weight: bold;">COVIDZ-19</h4>
            </div>
        </a>

        <!-- SideBar-Menu  -->

        <div>
            <ul>
                <router-link to="/ideas">
                    <li :class="[currentPage('Ideas') ? activeClass : '', 'menu-item']">
                        <div class="menu-item-container">
                            <!-- <img class="logo-img-menu"  src="/images/side-menu-icons/lamp.svg" alt=""> -->
                            <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-house-door" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.646 1.146a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5H9.5a.5.5 0 0 1-.5-.5v-4H7v4a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6zM2.5 7.707V14H6v-4a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v4h3.5V7.707L8 2.207l-5.5 5.5z" />
                                <path fill-rule="evenodd" d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                            </svg>
                            <h5 class="ml-3 header-logo-text-sidebar" style="font-weight: bold;">Ideas</h5>
                        </div>
                    </li>
                </router-link>
                <router-link class="hide-menu" to="/reports">
                    <li :class="[currentPage('Reports') ? activeClass : '', 'menu-item']">
                        <div class="menu-item-container">

                            <svg width="1.5625em" height="1.5em" viewBox="0 0 17 16" class="bi bi-exclamation-triangle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.938 2.016a.146.146 0 0 0-.054.057L1.027 13.74a.176.176 0 0 0-.002.183c.016.03.037.05.054.06.015.01.034.017.066.017h13.713a.12.12 0 0 0 .066-.017.163.163 0 0 0 .055-.06.176.176 0 0 0-.003-.183L8.12 2.073a.146.146 0 0 0-.054-.057A.13.13 0 0 0 8.002 2a.13.13 0 0 0-.064.016zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z" />
                                <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z" />
                            </svg>
                            <h5 class="header-logo-text-sidebar ml-3" style="font-weight: bold;">Reports</h5>
                        </div>
                    </li>
                </router-link>
                <a class="menu-item-link" href="">
                    <li class="menu-item">
                        <div class="menu-item-container">
                            <!-- <img class="logo-img-menu"  src="/images/side-menu-icons/newsfeed.svg" alt="">-->
                            <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-layout-text-window-reverse" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M2 1h12a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zm12-1a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12z" />
                                <path fill-rule="evenodd" d="M5 15V4H4v11h1zM.5 4h15V3H.5v1zM13 6.5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 .5-.5zm0 3a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 .5-.5zm0 3a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 .5-.5z" />
                            </svg>
                            <h5 class="header-logo-text-sidebar ml-3" style="font-weight: bold;">News</h5>
                        </div>
                    </li>
                </a>
                <a class="menu-item-link" href="">
                    <li class="menu-item">
                        <div class="menu-item-container">
                            <!-- <img class="logo-img-menu"  src="/images/side-menu-icons/graph.svg" alt=""> -->
                            <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-bar-chart-line" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M11 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h1V7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7h1V2zm1 12h2V2h-2v12zm-3 0V7H7v7h2zm-5 0v-3H2v3h2z" />
                            </svg>
                            <h5 class="ml-3 header-logo-text-sidebar" style="font-weight: bold;">Statistics</h5>
                        </div>
                    </li>
                </a>

                <a class="menu-item-link hide-menu" href="">
                    <li class="menu-item">
                        <div class="menu-item-container">
                            <!-- <img class="logo-img-menu"  src="/images/side-menu-icons/hashtag-half.svg" alt=""> -->
                            <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-tag" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M2 2v4.586l7 7L13.586 9l-7-7H2zM1 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 1 6.586V2z" />
                                <path fill-rule="evenodd" d="M4.5 5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1zm0 1a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                            </svg>
                            <h5 class="ml-3 header-logo-text-sidebar" style="font-weight: bold;">Explore</h5>
                        </div>
                    </li>
                </a>
                <a class="menu-item-link " href="">
                    <li class="menu-item">
                        <div class="menu-item-container">
                            <!-- <img class="logo-img-menu"  src="/images/side-menu-icons/bell.svg" alt=""> -->
                            <svg style="font-weight: bold;" width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-bell" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2z" />
                                <path fill-rule="evenodd" d="M8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z" />
                            </svg>
                            <h5 class="ml-3 header-logo-text-sidebar" style="font-weight: bold;">Notifications</h5>
                        </div>
                    </li>
                </a>
                <!-- <a class="menu-item-link hide-menu" href="">
                    <li class="menu-item">
                        <div class="menu-item-container">
                            <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-envelope" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383l-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z" />
                            </svg>
                            <h5 class="ml-3 header-logo-text-sidebar" style="font-weight: bold;">Messages</h5>
                        </div>
                    </li>
                </a> -->
                <router-link class="menu-item-link hide-menu" to="/bookmarks">
                    <li :class="[currentPage('Bookmarks') ? activeClass : '', 'menu-item']">
                        <div class="menu-item-container">
                            <!-- <img class="logo-img-menu"  src="/images/side-menu-icons/bookmark.svg" alt=""> -->
                            <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-bookmark" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z" />
                            </svg>
                            <h5 class="header-logo-text-sidebar ml-3" style="font-weight: bold;">Bookmarks</h5>
                        </div>
                    </li>
                </router-link>
                <router-link @click="edit" :to="'/' + $store.state.user.username" class="menu-item-link hide-menu">
                    <li class="menu-item">
                        <div class="menu-item-container">
                            <!-- <img class="logo-img-menu"  src="/images/side-menu-icons/bookmark.svg" alt=""> -->
                            <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-person-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                            </svg>
                            <h5 class="header-logo-text-sidebar ml-3" style="font-weight: bold;">Profile</h5>
                        </div>
                    </li>
                </router-link>
                <li class="button-part hide-menu" style="list-style: none;">
                    <div style="margin-top: 6%; mrgoin-bottom: 6%;">
                        <div>
                            <button @click="$modal.show('add-idea-modal')" id="post" class="btn btn-success btn-sidebar bi bi-lightning-fill ">
                                <svg width="1.25em" height="1.25em" viewBox="0 0 16 16" class="bi bi-plus-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                </svg>
                                <span class="text-button"> Add Idea</span>
                            </button>
                        </div>
                        <div>
                            <button @click="$modal.show('add-report-modal')" id="report" class="btn btn-danger btn-sidebar m-b-report">
                                <svg width="1.5625em" height="1.5em" viewBox="0 0 17 16" class="bi bi-exclamation-triangle-fill text-light" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 5zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                </svg>
                                <span class="text-button">Report</span>
                            </button>
                        </div>
                    </div>
                </li>
                <li class="menu-item humburger-list">

                    <button @click="hamb_click" class="btn hamburger" style="display; none;  padding: 0">
                        <svg viewBox="0 0 100 80" width="1.5em" height="1.5em" fill="currentColor">
                            <rect width="100" height="20" rx="8"></rect>
                            <rect y="30" width="100" height="20" rx="8"></rect>
                            <rect y="60" width="100" height="20" rx="8"></rect>
                        </svg>
                    </button>

                </li>

                <li class="profile-bottom hide-menu">
                    <button class="btn" style="width:100%" @click="toggle_menu('settings')">
                        <div class="profile-sidebar">
                            <div class="profile-link-right-side profile-ticket">
                                <img class="img-pb img-bottom" :src="$store.state.user.avatar" alt="">
                                <div class="profile-details ml-2 pt-2">
                                    <div style="display: block;">

                                        <div>
                                            <h6 style="font-weight: bold; margin-bottom: 0;">{{$store.state.user.fname + ' '+$store.state.user.lname }} </h6>
                                        </div>
                                        <div class="ml-2">
                                            <span class="text-secondary left" style="font-size: .9em;">{{ '@' + $store.state.user.username}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="up-arrow-part" style="margin-right:3%;">
                                <img style="width: 16px;height: 16px;" src="/images/side-menu-icons/arrow.svg">
                            </div>
                        </div>
                    </button>
                </li>
            </ul>
            <div id="settings" class="card shadow" style="display: none">
                <!-- <router-link :to="'/' + $store.state.user.username" >
                        <li>
                            <span class="font-weight-bold">Profile</span>
                        </li>
                    </router-link> -->
                <!-- <a href="">
                        <li>
                            <span class="font-weight-bold">Settings</span>
                        </li>
                    </a> -->

                <a class="btn text-light py-2 px-2" type="button" @click="logout">
                    <span class="font-weight-bold">Logout</span>
                    <form style="display: hidden" action="/logout" method="POST" id="logout">
                        <input type="hidden" name="_token" :value="csrf_token" />
                    </form>
                </a>
            </div>
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
div#settings {
    position: absolute;
    bottom: 130px;
    left: 24px;
    /* background: rgb(255, 109, 122); */
    background: rgb(28, 40, 51);
    /* background: rgb(21, 32, 43); */
    height: 100px;
    width: 240px;
    border-radius: 25px;
    box-shadow: 0 25px 20px -20px rgba(0, 0, 0, 0.1), 0 0 15px rgba(0, 0, 0, 0.06);
    display: flex;
    justify-content: center;
    align-items: stretch;
}

div#settings {
    padding-inline-start: 0px;
    margin-bottom: 0;
}

div#settings a {
    /* display: flex;
        justify-content: center;
        align-items: center; */
    border-bottom: #666 1px solid;
    border-top: #666 1px solid;
}

div#settings a span {
    font-size: 1.15em;
}

/* div#settings ul a:last-child {
        border-bottom: none;
        border-bottom-left-radius: 25px;
        border-bottom-right-radius: 25px;
    }
    div#settings ul a:first-child {
        border-top-left-radius: 25px;
        border-top-right-radius: 25px;
    } */
div#settings a:hover {
    background-color: rgba(58, 193, 114, 0.1) !important;
}
</style>

<script>
export default {
    props: ["categories", "wilayas"],
    data: function () {
        return {
            // categories: [],
            // wilayas: [],
            ideas: [],
            reports: [],
            cover: '',
            title: '',
            category: '',
            wilaya: '',
            address: '',
            body: '',
            imgPreview: '',
            data: new FormData(),
            csrf_token: window.csrf_token,
            activeClass: 'active',
            errors: '',
        }
    },
    beforeMount() {
        this.$Progress.start();
    },
    mounted() {
        this.getData();
        this.$route.push({
            "user": this.$store.state.user
        });
        this.$Progress.finish();
    },

    methods: {
        toggle_menu(e) {
            var d = document.getElementById(e);

            if (d.style.display == 'none') {
                d.style.display = 'flex';
            } else {
                d.style.display = 'none';
            }
        },
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
            document.getElementById('logout').submit();
        },
        newCover(event) {
            let files = event.target.files;
            console.log("file: " + files[0]);
            if (files.length) this.cover = files[0];
            console.log(this.cover)
            this.imgPreview = URL.createObjectURL(event.target.files[0]);
        },
        edit: function (joke) {
            this.$router.push({
                name: 'EditProfile',
                params: {
                    username: joke.username,
                     "user": this.$store.state.user
                }
            })
        },
        currentPage(slug){
            return this.$route.name.includes(slug);
        },
        clear(field){
            console.log(field);
            if(field){
                delete this.errors[field];
                return;
            }
            this.errors = {};
        },
        // Ideas APIs
        getData() {
            this.callAPI('get', '/ideas/data')
                .then((response) => {
                    console.log(response);
                    this.ideas = response;
                })
        },
        addIdea() {
            this.$Progress.start();
            this.data.set('title', this.title);
            this.data.set('body', this.body);
            this.data.set('image', this.cover);
            this.data.set("category", this.category);
            this.data.set('_method', "patch");
            this.callAPI('post', '/ideas/create', this.data)
                .then((response) => {
                    console.log(response);
                }).then(() => {
                    this.callAPI('get', '/ideas/data')
                        .then((response) => {
                            this.ideas = response;
                            console.log(response);
                        })
                })
                .then(() => {
                    this.$modal.hide("add-idea-modal");
                    this.title = '';
                    this.body = '';
                    this.cover = '';
                    this.imgPreview = ''
                })
                .catch((error) => {
                    console.log(error);
                    this.errors = error.errors;
                    this.$Progress.fail();
                });
            this.$Progress.finish();
        },
        addReport() {
            this.$Progress.start();
            this.data.set('title', this.title);
            this.data.set('body', this.body);
            this.data.set('image', this.cover);
            this.data.set('address', this.address);
            this.data.set("category", this.category);
            this.data.set("wilaya", array(this.wilaya));
            this.data.set('_method', "patch");
            this.callAPI('post', '/reports/create', this.data)
                .then((response) => {
                    console.log(response);
                }).then(() => {
                    this.callAPI('get', '/reports/data')
                        .then((response) => {
                            this.reports = response;
                            console.log(response);
                        })
                })
                .then(() => {
                    this.$modal.hide("add-report-modal");
                    this.title = '';
                    this.body = '';
                    this.cover = '';
                    this.address = '';
                    this.category = '';
                    this.wilaya = '';
                    this.imgPreview = ''
                })
                .catch((error) => {
                    console.log(error);
                    this.errors = error.errors;
                    this.$Progress.fail();
                });
            this.$Progress.finish();
        }

    }
}
</script>
