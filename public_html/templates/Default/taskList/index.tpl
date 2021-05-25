<body>
    <div class="panel">
        <div class="user-panel">
            <div class="">
                <form style="display: inline-flex;" action="/editor/add-task" method="POST">
                    <a href="/editor/add-task"><button type="submit" name="addTask" class="btn btn-success btn-sm">Добавить задачу</button></a>
                </form>
            </div>
            <div class="">
                <span>{SESSION_USER}</span>
                <form style="display: inline-flex;" action="/task-list" method="POST">
                    <button type="submit" name="logout" class="btn btn-danger btn-sm">Выйти</button>
                </form>
            </div>
        </div>
        <form action="/task-list" method="POST">
            <div class="filter">
                <button type="submit" name="currentTasks" class="btn btn-primary btn-sm">Текущие задачи</button>
                <button type="submit" name="overdueTasks" class="btn btn-danger btn-sm">Просроченные задачи</button>
                <button type="submit" name="completedTasks" class="btn btn-success btn-sm">Выполненные задачи</button>
                <button type="submit" name="tasksForToday" value="tasks-for-today"
                    class="btn btn-secondary btn-sm">Задачи на сегодня</button>
            </div>
        </form>
        <table class="task-table">
            <thead>
                <tr>
                    <td>Тема</td>
                    <td>Тип</td>
                    <td>Место</td>
                    <td>Дата</td>
                    <td>Время</td>
                    <td>Длительность</td>
                </tr>
            </thead>
            <tbody>
                {TASKS_TABLE_SHORT}
            </tbody>
        </table>

    </div>
</body>