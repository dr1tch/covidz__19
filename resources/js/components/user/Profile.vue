<template>
    <div>
        <Header :route ="$route.name"></Header>
        <ProfileHeader :user="$store.state.user"></ProfileHeader>
        <Ideas :user="$store.state.user"></Ideas>
        
    </div>
</template>

<script>
import ProfileHeader from './templates/Header-Profile'
import Header from './templates/header'
import Ideas from './templates/Ideas'
export default {
    components: {
        ProfileHeader,
        Ideas,
        Header,
    },
}
</script>