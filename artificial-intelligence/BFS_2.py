graph = {
    '5': ['3', '7'],
    '3': ['2', '4'],
    '7': ['8'],
    '2': [],
    '4': ['8'],
    '8': []
}

visited = []
queue = []

def bfs(visited, graph, start, goal):
    visited.append(start)
    queue.append([start])
    
    while queue:
        path = queue.pop(0)
        node = path[-1]
        
        if node == goal:
            return path        
        
        for neighbour in graph[node]:
            if neighbour not in visited:
                visited.append(neighbour)
                new_path = list(path)
                new_path.append(neighbour)
                queue.append(new_path)


path_goal = bfs(visited, graph, '5', '8')
if path_goal:
    print(path_goal)