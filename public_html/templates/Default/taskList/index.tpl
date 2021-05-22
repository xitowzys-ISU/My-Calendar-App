<body>
    <div class="panel">
        <form action="/task-list" method="POST">
            <div class="filter">
                <button type="submit" name="currentTasks" value="1" class="btn btn-primary btn-sm">Текущие задачи</button>
                <button type="submit" name="overdueTasks" class="btn btn-danger btn-sm">Просроченные задачи</button>
                <button type="submit" name="completedTasks" value="3" class="btn btn-success btn-sm">Выполненные задачи</button>
                <button type="submit" name="tasksForToday" value="tasks-for-today" class="btn btn-secondary btn-sm">Задачи на сегодня</button>
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