graph = {
    '5': ['3', '7'],
    '3': ['2', '4'],
    '7': ['8'],
    '2': [],
    '4': ['8'],
    '8': []
}

visited = set()

def dfs(visited, graph, node, goal, path=[]):
    path = path + [node]
    if node == goal:
        return path
    if node not in visited:
        visited.add(node)
        for neighbour in graph[node]:
            new_path = dfs(visited, graph, neighbour, goal, path)
            if new_path:
                return new_path
    
start = '5'
goal = '8'
path_goal = dfs(visited, graph, start,  goal)
if path_goal:
    print(path_goal)