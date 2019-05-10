<template>
    <div class="navbar">
        <li v-for="(menuItem,index) in menuItems" :key="index" class="nav-item">
            <a class="nav-link" v-if="menuItem.show" href @click.prevent="$router.push({ name: menuItem.route})">
                {{menuItem.title}}
                <i v-if="menuItem.icon" :class="menuItem.icon" class="fa text-danger"></i>
            </a>
        </li>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                menuItems: [
                    {
                        title: "Write a new post",
                        route: "create-post",
                        show: this.$auth.user != null
                    },
                    {
                        title: "Topics",
                        route: "show-topics",
                        show: true
                    }
                ]
            };
        }, watch: {
            $route(to, from) {
                console.log("helo");
                this.menuItems =
                    [
                        {
                            title: "Write a new post",
                            route: "create-post",
                            show: this.$auth.user != null
                        },
                        {
                            title: "Topics",
                            route: "show-topics",
                            show: true
                        }
                    ]
                ;
            }
        }
    };
</script>
