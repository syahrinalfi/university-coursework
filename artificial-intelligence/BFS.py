graph = {
    '5': ['3', '7'],
    '3': ['2', '4'],
    '7': ['8'],
    '2': [],
    '4': ['8'],
    '8': []
}

visited = []  # List for visited nodes.
queue = []  # Initialize a queue

def bfs(visited, graph, start, goal):  # function for BFS
    visited.append(start)
    queue.append([start])
    
    while queue:          # Creating loop to visit each node
        path = queue.pop(0)
        node = path[-1]
        print(node, end=" ")

        if node == goal:
            return path

        for neighbour in graph[node]:
            if neighbour not in visited:
                visited.append(neighbour)
                new_path = list(path)
                new_path.append(neighbour)
                queue.append(new_path)

# Driver Code
print("Following is the Breadth-First Search")
goal_node = '8'
result_path = bfs(visited, graph, '5', goal_node)
if result_path:
    print("\nPath to", goal_node, ":", result_path)
else:
    print("\nNo path found to", goal_node)
