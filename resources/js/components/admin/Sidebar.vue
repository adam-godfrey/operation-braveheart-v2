<template>
  <sidebar-menu :menu="menu" :showOneChild="true" @toggle-collapse="onToggleCollapse"/>
</template>

<script>
    import { SidebarMenu } from 'vue-sidebar-menu'
    export default {
        data() {
            return {
                menu: [
                    {
                        header: true,
                        title: 'Main Navigation',
                        hiddenOnCollapse: true
                    },
                    {
                        href: '/',
                        title: 'Dashboard',
                        icon: 'fa fa-user'
                    },
                    {
                        title: 'Memorial Garden',
                        icon: 'fas fa-dove',
                        child: [
                            {
                                href: '/admin/memorial-garden',
                                title: 'Dashboard'
                            },
                            {
                                header: true,
                                title: 'Plaque Orders',
                                hiddenOnCollapse: true
                            },
                            {
                                href: '/admin/memorial-garden/plaque-orders',
                                title: 'View All'
                            }
                        ]
                    },
                    {
                        title: 'Lottery',
                        icon: 'fas fa-ticket-alt',
                        child: [
                            {
                                href: '/admin/lottery',
                                title: 'Dashboard'
                            },
                            {
                                href: '/admin/lottery/settings',
                                title: 'Settings'
                            },
                            {
                                header: true,
                                title: 'Draw Numbers',
                                hiddenOnCollapse: true
                            },
                            {
                                href: '/admin/lottery/draw/uk',
                                title: 'UK'
                            },
                            {
                                href: '/admin/lottery/draw/local',
                                title: 'Local'
                            },
                            {
                                header: true,
                                title: 'Players',
                                hiddenOnCollapse: true
                            },
                            {
                                href: '/admin/lottery/players/create',
                                title: 'Create New'
                            },
                            {
                                href: '/admin/lottery/players',
                                title: 'View All'
                            }
                        ]
                    },
                    {
                        title: 'News',
                        icon: 'far fa-newspaper',
                        child: [
                            {
                                href: '/admin/memorial-garden"',
                                title: 'Dashboard'
                            },
                            {
                                header: true,
                                title: 'Plaque Orders',
                                hiddenOnCollapse: true
                            },
                            {
                                href: '/admin/memorial-garden/plaque-orders',
                                title: 'View All'
                            }
                        ]
                    },
                    {
                        title: 'Messaging',
                        icon: 'far fa-envelope',
                        child: [
                            {
                                href: '/admin/memorial-garden',
                                title: 'Dashboard'
                            },
                            {
                                header: true,
                                title: 'Plaque Orders',
                                hiddenOnCollapse: true
                            },
                            {
                                href: '/admin/memorial-garden/plaque-orders',
                                title: 'View All'
                            }
                        ]
                    },
                ]
            }
        },
        components: {
            SidebarMenu
        },
        methods: {
            onToggleCollapse(collapsed) {
                console.log(collapsed)
                var v = document.getElementById('app'); 
                if(collapsed) {
                    v.classList.add('collapsed');
                }
                else {
                    v.classList.remove('collapsed');
                }
            },
            
        }
    }
</script>