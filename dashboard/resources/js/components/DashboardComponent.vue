<template>
    <div class="container-fluid">
        <div :class="{ 'overlay': isOverlay }"></div>
        <div class="row">
            <div class="col sidenav">
                <Sidenav></Sidenav>
            </div>
            <div class="col-10">
                <div class="row">
                    <IssueFilter
                        :categories="categoryList"
                    ></IssueFilter>
                </div>
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
import IssueFilter from './IssueFilter'

export default {
    components: {
        IssueList,
        Sidenav,
        IssueFilter,
    },
    data() {
        return {
            issues: [],
            isOverlay: true,
            categoryList: [],
        }
    },
    mounted() {
        this.fetchIssues()
    },
    methods: {
        fetchIssues: function() {
            axios.get('/issues').then(response => {
                this.issues = response.data
                this.isOverlay = false
            })
        },
        changeStatus: function(event) {
            if (window.confirm(`課題を${event.status}に移動しますか？`)) {
                this.isOverlay = true
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
        },

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
    visibility: visible;
    transition: .3s linear;
    opacity: 1;
}

</style>