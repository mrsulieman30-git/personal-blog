import sys
from PIL import Image

def invert_and_transparent(input_path, output_path):
    # Open the image and convert to RGBA
    img = Image.open(input_path).convert("RGBA")
    
    # Get data
    datas = img.getdata()
    
    newData = []
    for item in datas:
        # Get the luminance of the original pixel
        # luminance = 0.299*R + 0.587*G + 0.114*B
        luminance = int(0.299 * item[0] + 0.587 * item[1] + 0.114 * item[2])
        
        # We want the text to be white, so color is always 255, 255, 255
        # We want the alpha to be high where it was originally dark, and 0 where it was white
        # So new_alpha = 255 - luminance
        
        newData.append((255, 255, 255, 255 - luminance))
        
    img.putdata(newData)
    
    # Save as PNG
    img.save(output_path, "PNG")

if __name__ == "__main__":
    invert_and_transparent(sys.argv[1], sys.argv[2])
