document.addEventListener("DOMContentLoaded", () => {
  // Aguarda o carregamento completo do documento

  // Seleciona elementos do DOM
  const inputElement = document.querySelector(".new-task-input");
  const addTaskButton = document.querySelector(".new-task-button");
  const tasksContainer = document.querySelector(".tasks-container");
  const tasksCount = document.querySelector(".tasks-count");

  // Validação da entrada
  const validateInput = () => inputElement.value.trim().length > 0;

  // Atualiza a contagem de tarefas
  const updateTasksCount = () => {
    const taskCount = document.querySelectorAll(".task-item").length;
    tasksCount.textContent = `${taskCount} tarefa${taskCount !== 1 ? "s" : ""}`;
  };

  // Manipula adição de tarefas
  const handleAddTask = () => {
    const inputIsValid = validateInput();

    if (!inputIsValid) {
      inputElement.classList.add("error");
      return;
    }

    inputElement.classList.remove("error");

    const taskItemContainer = document.createElement("div");
    taskItemContainer.classList.add("task-item");

    const taskContent = document.createElement("p");
    taskContent.innerText = inputElement.value;

    taskContent.addEventListener("click", () => handleCompleteClick(taskContent));

    const deleteItem = document.createElement("i");
    deleteItem.classList.add("fa", "fa-trash-alt");  // Use "fa" ao invés de "far"

    // Adicionar confirmação antes de deletar
    deleteItem.addEventListener("click", () => {
      const shouldDelete = confirm("Tem certeza que deseja excluir esta tarefa?");
      if (shouldDelete) {
        handleDeleteClick(taskItemContainer);
      }
    });

    taskItemContainer.appendChild(taskContent);
    taskItemContainer.appendChild(deleteItem);

    tasksContainer.appendChild(taskItemContainer);

    inputElement.value = "";
    updateTasksCount();
    updateLocalStorage();
  };

  // Manipula marcação de tarefa como concluída
  const handleCompleteClick = (taskContent) => {
    taskContent.closest(".task-item").classList.toggle("completed");
    updateLocalStorage();
  };

  // Manipula exclusão de tarefa
  const handleDeleteClick = (taskItemContainer) => {
    taskItemContainer.addEventListener("click", () => {
      taskItemContainer.remove();
      updateTasksCount();
      updateLocalStorage();
    });

    taskItemContainer.classList.add("deleting");
  };

  // Atualiza armazenamento local
  const updateLocalStorage = () => {
    const tasks = tasksContainer.querySelectorAll(".task-item");

    const localStorageTasks = Array.from(tasks).map((task) => {
      const content = task.querySelector("p");
      const isCompleted = task.classList.contains("completed");

      return { description: content.innerText, isCompleted };
    });

    localStorage.setItem("tasks", JSON.stringify(localStorageTasks));
  };

  // Carrega tarefas do armazenamento local e exibe
  const refreshTasksUsingLocalStorage = () => {
    const tasksFromLocalStorage = JSON.parse(localStorage.getItem("tasks"));

    if (tasksFromLocalStorage) {
      tasksFromLocalStorage.forEach((task) => {
        const taskItemContainer = document.createElement("div");
        taskItemContainer.classList.add("task-item");

        const taskContent = document.createElement("p");
        taskContent.innerText = task.description;

        if (task.isCompleted) {
          taskItemContainer.classList.add("completed");
        }

        taskContent.addEventListener("click", () => handleCompleteClick(taskContent));

        const deleteItem = document.createElement("i");
        deleteItem.classList.add("fa", "fa-trash-alt");  // Use "fa" ao invés de "far"

        // Adicionar confirmação antes de deletar
        deleteItem.addEventListener("click", () => {
          const shouldDelete = confirm("Tem certeza que deseja excluir esta tarefa?");
          if (shouldDelete) {
            handleDeleteClick(taskItemContainer);
          }
        });

        taskItemContainer.appendChild(taskContent);
        taskItemContainer.appendChild(deleteItem);

        tasksContainer.appendChild(taskItemContainer);
      });

      updateTasksCount();
    }
  };

  // Carrega as tarefas armazenadas localmente e atualiza a contagem
  refreshTasksUsingLocalStorage();
  updateTasksCount();

  // Event listener para adicionar tarefa ao clique do botão
  addTaskButton.addEventListener("click", handleAddTask);

  // Event listener para remover a classe de erro ao digitar
  inputElement.addEventListener("input", () => {
    inputElement.classList.remove("error");
  });
});
