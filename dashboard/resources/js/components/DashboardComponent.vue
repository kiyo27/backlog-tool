<template>
    <div class="container-fluid">
        <div class="overlay" :class="{ 'is-open': isOpen }"></div>
        <div class="row">
            <div class="col sidenav">
                <Sidenav></Sidenav>
            </div>
            <div class="col-10">
                <div class="row">
                    <IssueList
                        :issueList="tasksTodo"
                        issueStatus="Open"
                        nextStatus="wip"
                        @refresh="fetchIssues"
                        @move="changeStatus($event)"
                    ></IssueList>
                    <IssueList
                        :issueList="tasksWorkInProgress"
                        issueStatus="WIP"
                        nextStatus="done"
                        backStatus="open"
                        @refresh="fetchIssues"
                        @move="changeStatus($event)"
                    ></IssueList>
                    <IssueList
                        :issueList="tasksDone"
                        issueStatus="Done"
                        backStatus="wip"
                        @refresh="fetchIssues"
                        @move="changeStatus($event)"
                    ></IssueList>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import IssueList from './IssueList'
import Sidenav from './Sidenav'

export default {
    components: {
        IssueList,
        Sidenav,
    },
    data() {
        return {
            issues: [],
            isOpen: true
        }
    },
    mounted() {
        this.fetchIssues()
    },
    methods: {
        fetchIssues: function() {
            axios.get('/issues').then(response => {
                this.issues = response.data
                this.isOpen = false
            })
        },
        changeStatus: function(event) {
            if (window.confirm(`課題を${event.status}に移動しますか？`)) {
                this.isOpen = true
                axios.post('/api/issue/update', {
                    taskId: event.taskId,
                    status: event.status
                })
                .then((response) => {
                    this.fetchIssues()
                })
            }
        }
    },
    computed: {
        tasksTodo: function() {
            if (this.issues === []) {
                return []
            }
            return this.issues.filter(function(issue) {
                return issue.status.id === 1
            })
        },

        tasksWorkInProgress: function() {
            if (this.issues === []) {
                return []
            }
            return this.issues.filter(function(issue) {
                return issue.status.id === 2
            })
        },

        tasksDone: function() {
            if (this.issues === []) {
                return []
            }
            return this.issues.filter(function(issue) {
                return issue.status.id === 3
            })
        }
    }
}
</script>

<style lang="scss">
.kanban {

    &__item {
        padding: 10px 10px 0 10px;
        
        &:last-child {
            padding-bottom: 10px;
        }
    }
}

.sidenav {
    padding-left: 0;
}

.overlay {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 3;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, .7);
    opacity: 0;
    visibility: hidden;
    transition: .3s linear;
}

.overlay.is-open {
    opacity: 1;
    visibility: visible;
}
</style>