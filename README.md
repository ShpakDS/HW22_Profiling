# HW22_Profiling

# Operation Tree Profiling

This project implements a Balanced Binary Search Tree (AVL Tree) in PHP, profiles its space and time complexity, and
outputs the results.

## How to Run

1. Build and run the Docker container:
   ```bash
   docker-compose up --build```

# Operation Tree Profiling

This project implements a Balanced Binary Search Tree (AVL Tree) in PHP to profile the time and memory complexity of insertion, search, and deletion operations. The results are compared against expected theoretical performance (O(log n) for time complexity and O(n) for space complexity).

---

## **Results**

The profiling results for the operations on a dataset of 100,000 keys are as follows:

### **Performance Metrics**
| Operation | Execution Time | Throughput (ops/sec) | Description |
|-----------|----------------|-----------------------|-------------|
| **Insert** | 0.287 s | ~348,000 ops/sec | Time taken to insert all keys into the AVL tree. |
| **Search** | 0.029 s | ~3,453,000 ops/sec | Time taken to search for 50,000 random keys. |
| **Delete** | 0.091 s | ~1,098,000 ops/sec | Time taken to delete 30,000 random keys. |

### **Memory Usage**
- **Memory Consumption:** 8,384,064 bytes (~8 MB) for the AVL tree containing 100,000 nodes.

---

## **Key Observations**
1. **Insert Performance:**
   - Time complexity approximates **O(log n)** as expected.
   - The throughput of ~348,000 ops/sec