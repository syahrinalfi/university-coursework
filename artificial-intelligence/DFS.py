graph = {
    '5': ['3', '7'],
    '3': ['2', '4'],
    '7': ['8'],
    '2': [],
    '4': ['8'],
    '8': []
}

visited = set()  # Set to keep track of visited nodes of graph.


def dfs(visited, graph, node, goal, path=[]):  # function for dfs
    path = path + [node]  # Menyalin jalur saat ini dan menambahkan node baru
    if node == goal:
        return path
    if node not in visited:
        visited.add(node)
        for neighbour in graph[node]:
            # Rekursi untuk menemukan jalur
            new_path = dfs(visited, graph, neighbour, goal, path)
            if new_path:
                return new_path


# Driver Code
print("Following is the Depth-First Search")
goal_node = '8'
path_to_goal = dfs(visited, graph, '5', goal_node)
if path_to_goal:
    print("Path to", goal_node, ":", path_to_goal)
else:
    print("No path found to", goal_node)
