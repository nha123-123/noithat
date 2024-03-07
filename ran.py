import pygame
import sys
import random

# Thiết lập màn hình
WIDTH, HEIGHT = 800, 600
WIN = pygame.display.set_mode((WIDTH, HEIGHT))
pygame.display.set_caption("Puzzle Game")

# Màu sắc
WHITE = (255, 255, 255)
BLACK = (0, 0, 0)

# Kích thước của mỗi mảnh ảnh
PIECE_SIZE = 200

# Load hình ảnh
image = pygame.image.load('tải xuống.png')
image = pygame.transform.scale(image, (WIDTH, HEIGHT))
pieces = []

# Tạo các mảnh ảnh
for i in range(3):
    for j in range(3):
        piece = image.subsurface((i * PIECE_SIZE, j * PIECE_SIZE, PIECE_SIZE, PIECE_SIZE))
        pieces.append(piece)

# Hàm trộn các mảnh ảnh
def shuffle_pieces():
    random.shuffle(pieces)

# Hàm vẽ các mảnh ảnh
def draw_pieces():
    for i, piece in enumerate(pieces):
        row = i // 3
        col = i % 3
        WIN.blit(piece, (col * PIECE_SIZE, row * PIECE_SIZE))

# Hàm kiểm tra xem trò chơi đã hoàn thành chưa
def check_win():
    for i, piece in enumerate(pieces):
        row = i // 3
        col = i % 3
        if (row, col) != (2, 2):
            if piece != image.subsurface((col * PIECE_SIZE, row * PIECE_SIZE, PIECE_SIZE, PIECE_SIZE)):
                return False
    return True

# Hàm main
def main():
    shuffle_pieces()

    run = True
    while run:
        for event in pygame.event.get():
            if event.type == pygame.QUIT:
                run = False
            if event.type == pygame.MOUSEBUTTONDOWN:
                mouse_pos = pygame.mouse.get_pos()
                clicked_piece = (mouse_pos[1] // PIECE_SIZE) * 3 + (mouse_pos[0] // PIECE_SIZE)
                row, col = clicked_piece // 3, clicked_piece % 3
                adjacent_pieces = []
                if row > 0:
                    adjacent_pieces.append((row - 1) * 3 + col)
                if row < 2:
                    adjacent_pieces.append((row + 1) * 3 + col)
                if col > 0:
                    adjacent_pieces.append(row * 3 + (col - 1))
                if col < 2:
                    adjacent_pieces.append(row * 3 + (col + 1))
                for adj_piece in adjacent_pieces:
                    pieces[adj_piece], pieces[clicked_piece] = pieces[clicked_piece], pieces[adj_piece]
                if check_win():
                    print("You win!")

        WIN.fill(WHITE)
        draw_pieces()
        pygame.display.update()

    pygame.quit()

if __name__ == "__main__":
    pygame.init()
    main()
