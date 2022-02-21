import Principal from './components/principal/Principal';
import Home from './components/home/Home.vue';

export default [
	{
		path: '/home',
		name: 'home',
		component: Home,
		meta: {}
	},
	{
		path: '/',
		name: 'principal',
		component: Principal,
		meta: {}
	}
];