import VueRouter from 'vue-router';

import jobs from './components/jobs/jobs.vue';
import job from './components/jobs/job.vue';
import applyJob from './components/jobs/applyJob.vue'

import applications from './components/applications/applications.vue';
import application from './components/applications/application.vue'

let routes = [
  {
    path: '/jobs',
    name: 'jobs',
    component: jobs,
    props: true
  },
  {
    path: '/jobs/:id',
    name: 'jobs.show',
    component: job,
    props: true
  },
  {
    path: '/jobs/:id/apply',
    name: 'job.apply',
    component: applyJob,
    props: true
  },
  {
    path: '/applications',
    name: 'applications',
    component: applications,
    props: true
  },
  {
    path: '/applications/:id',
    name: 'applications.show',
    component: application,
    props: true
  },
];

export default new VueRouter({
  mode: 'history',
  routes: routes
});

// Important To-DO
// https://forum.vuejs.org/t/pass-props-for-different-components-via-one-router-view/1489/2