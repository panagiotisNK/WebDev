
 <form name="uploadForm">
      <div>
        <input id="uploadInput" type="file" multiple>
        selected files: <output id="fileNum">0</output>;
        total size: <output id="fileSize">0</output>
      </div>
      <div><input type="submit" value="Send file"></div>
    </form>

    <script>
      const uploadInput = document.getElementById("uploadInput");
      uploadInput.addEventListener("change", () => {
        // Calculate total size
        let numberOfBytes = 0;
        for (const file of uploadInput.files) {
          numberOfBytes += file.size;
        }

        // Approximate to the closest prefixed unit
        const units = ["B", "KiB", "MiB", "GiB", "TiB", "PiB", "EiB", "ZiB", "YiB"];
        const exponent = Math.min(
          Math.floor(Math.log(numberOfBytes) / Math.log(1024)),
          units.length - 1,
        );
        const approx = numberOfBytes / 1024 ** exponent;
        const output = exponent === 0 
          ? `${numberOfBytes} bytes` 
          : `${approx.toFixed(3)} ${units[exponent]} (${numberOfBytes} bytes)`;

        document.getElementById("fileNum").textContent = fileList.length;
        document.getElementById("fileSize").textContent = output;
      }, false);
    </script>