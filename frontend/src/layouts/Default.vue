<template>
    <div>
        <!-- Navbar -->
        <nav id="MagicMenu" class="topnav navbar navbar-expand-lg navbar-light bg-white fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#" @click.prevent="$router.push({ name: 'home'})">
                    <strong>COLLAB</strong>
                </a>
                <button
                    class="navbar-toggler collapsed"
                    type="button"
                    data-toggle="collapse"
                    data-target="#navbarColor02"
                    aria-controls="navbarColor02"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse" id="navbarColor02">
                    <ul class="navbar-nav mr-auto d-flex align-items-center">
                        <MenuHeader/>
                    </ul>
                    <ul class="navbar-nav ml-auto d-flex align-items-center">
                        <Search/>
                    </ul>
                    <UserNavBar/>
                </div>
            </div>
        </nav>

        <!-- Content -->
        <main role="main" class="site-content">
            <transition name="router" mode="out-in">
                <router-view/>
            </transition>
        </main>

        <AppFooter/>
    </div>
</template>

<script>


    import MenuHeader from "@/components/layout/menu-header.vue";
    import Search from "@/components/layout/search.vue";
    import AppFooter from "@/components/layout/app-footer.vue";
    import UserNavBar from "@/components/layout/user-nav-bar.vue";

    export default {
        name: "MainLayout",
        components: {MenuHeader, Search, AppFooter, UserNavBar}
    };
</script>
